<template>
    <v-card>
        <v-card-title><h2>Категории</h2></v-card-title>
        <v-card-text>
            <v-container grid-list-md fluid>
                <v-layout row wrap>
                    <v-flex md6>
                        <v-treeview :active.sync="active" activatable :items="categories" class="grey lighten-5" transition>
                        </v-treeview>
                    </v-flex>
                    <v-flex md6>
                        <v-card v-if="selected !== undefined">
                            <v-card-title>
                                <h3>{{selected.name}}</h3>
                            </v-card-title>
                            <v-card-actions style="flex-wrap: wrap;">
                                <v-btn color="success" @click.stop="addSub(selected)">Создать подкатегорию</v-btn>
                                <v-btn color="primary" @click.stop="editCat(selected)">Редактировать</v-btn>
                                <v-btn color="error" @click.stop="deleteCat(selected)">Удалить</v-btn>
                                <div style="width: 100%;">&nbsp;</div>
                                <div class="move mt2 flex">
                                    <v-btn @click.stop="moveCat(selected, 'up')"><v-icon>arrow_upward</v-icon></v-btn>
                                    <v-btn @click.stop="moveCat(selected, 'down')"><v-icon>arrow_downward</v-icon></v-btn>
                                </div>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>

        <v-dialog v-model="editingActive" max-width="500px">
            <v-card v-if="editedCategory !== null">
                <v-card-title class="headline">Edit category</v-card-title>
                <v-card-text>
                    <v-form v-model="editValid" lazy-validation>
                        <v-select :items="parentCatItems" label="Родитель новой категории" required v-model="editedCategory.parentId"></v-select>
                        <v-text-field v-model="editedCategory.name" required label="Название категории"></v-text-field>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="success" @click="saveCategory()">Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
    async function getCategories($axios) {
        let {data} = await $axios.get("admin/categories/tree");
        let categoriesById = [];
        let traceCategories = categories => {
            for (let c of categories) {
                categoriesById[c.id] = c;
                if (c.children !== undefined && c.children.length) {
                    traceCategories(c.children);
                }
            }
        };
        traceCategories(data);
        return {categories: data, categoriesById};
    }

    const defaultCat = {
        parentId: null,
        name: "",
        id: null
    };

    export default {
        name: "categories",
        async asyncData({app}) {
            return await getCategories(app.$axios);
        },
        data() {
            return {
                active: [],
                editedCategory: null,
                editingActive: false,
                editValid: true,
            }
        },
        computed: {
            selected() {
                if (!this.active.length) return undefined;
                return this.categoriesById[this.active[0]];
            },
            parentCatItems() {
                let result = [];
                let trace = (categories, level = 0) => {
                    for (let c of categories) {
                        let itemTitle = c.name;
                        if (level > 0) {
                            itemTitle = itemTitle.padStart(itemTitle.length + level + 5, "  ");
                        }
                        result.push({text: itemTitle, value: c.id});
                        if (c.children) {
                            trace(c.children, level + 1);
                        }
                    }
                };
                trace(this.categories);
                return result;
            }
        },
        methods: {
            addSub(parent) {
                let newCat = Object.assign({}, defaultCat);
                newCat.parentId = parent.id;
                this.editedCategory = newCat;
                this.editingActive = true;
            },
            editCat(cat) {
                let newCat = Object.assign({}, defaultCat);
                newCat.id = cat.id;
                newCat.parentId = cat.parent_id;
                newCat.name = cat.name;
                this.editedCategory = newCat;
                this.editingActive = true;
            },
            saveCategory() {
                this.$axios.post("admin/categories/store", this.editedCategory).then(
                    (resp) => {
                        this.updateCategories();
                        this.editedCategory = null;
                        this.editingActive = false;
                    }
                )
            },
            deleteCat(category) {
                if (!confirm(`Вы действительно хотите удалить ${category.name}?`)) {
                    return;
                }
                this.$axios.delete(`admin/categories/${category.id}`).then(
                    () => {
                        this.updateCategories();
                    }
                )
            },
            async moveCat(category, where) {
                await this.$axios.post(`admin/categories/${category.id}/${where}`);
                await this.updateCategories();
            },
            async updateCategories() {
                let categoriesData = await getCategories(this.$axios);
                this.categories = categoriesData.categories;
                this.categoriesById = categoriesData.categoriesById;
            }
        }
    }
</script>

<style scoped>

</style>
