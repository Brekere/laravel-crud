<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Título"
            :variant="errors.title ? 'danger' : 'primary'"
            :message="errors.title"
        >
            <o-input v-model="form.title"></o-input>
        </o-field>

        <o-field
        :variant="errors.description ? 'danger' : 'primary'"
        :message="errors.description"
        label="Descripción"
        >
        <o-input v-model="form.description" type="textarea"></o-input>
        </o-field>

        <o-field
        :variant="errors.content ? 'danger' : 'primary'"
        :message="errors.content"
        label="Contenido"
        >
        <o-input v-model="form.content" type="textarea"></o-input>
        </o-field>

        <o-field
        :variant="errors.category_id ? 'danger' : 'primary'"
        :message="errors.category_id"
        label="Categoría"
        >
        <o-select
            v-model="form.category_id"
            placeholder="Seleccione una categoría"
        >
            <option v-for="c in categories" v-bind:key="c.id" :value="c.id">
            {{ c.title }}
            </option>
        </o-select>
        </o-field>
        
        <o-field
        :variant="errors.posted ? 'danger' : 'primary'"
        :message="errors.posted"
        label="Posted"
        >
        <o-select v-model="form.posted" placeholder="Seleccione un estado">
            <option value="yes">Si</option>
            <option value="not">No</option>
        </o-select>
        </o-field>

        <o-button variant="primary" native-type="submit">
            Enviar
        </o-button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            form: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            errors: {
                title: "",
                description: "",
                content: "",
                category_id: "",
                posted: "",
            },
            post:""
        }
    },
    async mounted() {
        if(this.$route.params.slug){
            await this.getPost();
            console.log(this.post)
            this.initPost();
        }
        this.getCategory()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.title = "";
            this.errors.description = "";
            this.errors.category_id = "";
            this.errors.content = "";
            this.errors.posted = "";
        },
        getCategory() {
            this.$axios.get("/api/category/all").then(res => {
                this.categories = res.data
            })
        },
        async getPost() {
            this.post = await this.$axios.get("/api/post/slug/"+this.$route.params.slug);
            this.post = this.post.data
        },
        initPost(){
            this.form.title = this.post.title
            this.form.description = this.post.description
            this.form.content = this.post.content
            this.form.category_id = this.post.category_id
            this.form.posted = this.post.posted
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.post == "") {
                return this.$axios
                .post("/api/post", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.title)
                        this.errors.title = error.response.data.title[0];

                    if (error.response.data.description)
                        this.errors.description = error.response.data.description[0];

                    if (error.response.data.category_id)
                        this.errors.category_id = error.response.data.category_id[0];

                    if (error.response.data.posted)
                        this.errors.posted = error.response.data.posted[0];

                    if (error.response.data.content)
                        this.errors.content = error.response.data.content[0];
                })
                
            }
            this.$axios
                .patch("/api/post/"+this.post.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.title)
                        this.errors.title = error.response.data.title[0];

                    if (error.response.data.description)
                        this.errors.description = error.response.data.description[0];

                    if (error.response.data.category_id)
                        this.errors.category_id = error.response.data.category_id[0];

                    if (error.response.data.posted)
                        this.errors.posted = error.response.data.posted[0];

                    if (error.response.data.content)
                        this.errors.content = error.response.data.content[0];
                })
            
        }
    }
}
</script>