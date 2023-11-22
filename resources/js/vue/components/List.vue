<template>
    <div>
        <h1>Listado de post</h1>

        <router-link :to="{name:'save'}">Crear</router-link>

        <o-table :loading="isLoading" :data="posts.current_page && posts.data.length == 0 ? [] : posts.data">
            <o-table-column field="id" label="id" numeric v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field="title" label="Titulo" v-slot="p">
                {{ p.row.title }}
            </o-table-column>
            <o-table-column field="posted" label="Posteado" v-slot="p">
                {{ p.row.posted }}
            </o-table-column>
            <o-table-column field="created_at" label="Fecha" v-slot="p">
                {{ p.row.created_at }}
            </o-table-column>
            <o-table-column field="category" label="Categoria" v-slot="p">
                {{ p.row.category.title }}
            </o-table-column>
            <o-table-column field="slug" label="Acciones" v-slot="p">
                <router-link :to="{name:'save',params:{'slug': p.row.slug}}">Editar</router-link>
                <o-button variant="danger" @click="deletePost(p)">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <br>

        <o-pagination
        v-if="posts.current_page && posts.data.length > 0" 
        @change="updatePage"
            :total="posts.total"
            v-model:current.sync="currentPage"
            :range-before="2"
            :range-after="2"
            order="centered"
            size="small"
            :simple="false"
            :rounded="true"
            :per-page="posts.per_page"
        >
        </o-pagination>

    </div>
</template>

<script>

export default {

    data() {
        return {
            posts: [],
            isLoading: true,
            currentPage:1
        }
    },

    methods:{

        updatePage(){
            setTimeout(this.listPage,100);
        },

        listPage(){
            this.isLoading = true
            this.$axios.get('/api/post?page='+this.currentPage).then((res) => {
            this.posts = res.data,
            this.isLoading = false
        });
        },

        deletePost(row){
            //this.posts.data.splice(row.index,1)
            console.log(row)
            //this.$axios.delete("/api/post/"+row.row.id)
        }
    },

    async mounted() {
        this.listPage()
    }
};
</script>