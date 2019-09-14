<template>
    <v-card>
        <v-card-title>
            Новый пост
        </v-card-title>
        <v-card-text>
            <v-form>
                <v-text-field v-model="post.title" label="Название" required></v-text-field>
                <v-treeview :items="blogCategories">
                    <template v-slot:prepend="{ item, open }">
                        <input type="checkbox" :checked="post.categories.indexOf(item.id) !== -1" @change="checkCat(item.id, $event.target.checked)">
                    </template>
                </v-treeview>
                <v-textarea v-model="post.short" label="Краткое содержание" required></v-textarea>
                <v-textarea v-model="post.content" label="Полное содержание" rows="30" required></v-textarea>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-btn color="success" @click="save()">Сохранить</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                post: {
                    title: "",
                    content: "",
                    short: "",
                    categories: []
                },

            }
        },
        async asyncData({app}) {
            let {data} = await app.$axios.get("admin/categories/tree");
            return {blogCategories: data};
        },
        methods: {
            save() {
                this.$axios.post("admin/posts", this.post).then(
                    (resp) => {
                        this.$router.push("/admin/posts/posts");
                    }
                )
            },
            checkCat(cat_id, checked) {
                if (checked) {
                    this.post.categories.push(cat_id);
                } else {
                    this.post.categories = this.post.categories.filter((id) => id != cat_id);
                }
            }
        }
    }
</script>

<style scoped>

</style>
