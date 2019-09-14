<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>My Posts</v-toolbar-title>
            <v-divider
                    class="mx-2"
                    inset
                    vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-btn color="primary" dark class="mb-2" to="/admin/posts/new">New Item</v-btn>
        </v-toolbar>
        <v-data-table
                :headers="[{text: 'id', sortable: true}, {text: 'Название', sortable: true}, {text: 'Категории'}, {text: 'Действия'}]"
                :items="posts"
                class="elevation-1"
        >
            <template v-slot:items="props">
                <td>{{ props.item.id }}</td>
                <td>{{ props.item.title }}</td>
                <td>

                </td>
                <td class="justify-center layout px-0">
                    <v-icon
                            small
                            class="mr-2"
                            @click="editItem(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                            small
                            @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
            <template v-slot:no-data>
                Нет постов
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "posts",
        async asyncData({app}) {
            let {data} = await app.$axios.get("/admin/posts");
            return {
                posts: data
            }
        }
    }
</script>

<style scoped>

</style>
