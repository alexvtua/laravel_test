<template>
    <div class="books">
        <h1 class="text-lg-center">Book title: {{ book.title }}</h1>
        <h3>Author:
            <router-link :to="{name: 'author', params: {id: author.id}}">
                <a class="text-lg-center">{{ author.first_name }} {{ author.last_name }}</a>
            </router-link>
        </h3>
    </div>
</template>

<script>
    export default {
        created() {
            this.getBook();
        },

        data() {
            return {
                book: [],
                bookEndpoint: '/api/books/'
            };
        },

        methods: {
            getBook() {
                let id = this.$route.params.id;

                axios.get(this.bookEndpoint + id)
                    .then(response => {
                        let data = response.data;
                        this.book = data.attributes;
                        this.author = data.attributes.author;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
        }
    }
</script>