<template>
    <div class="books">
        <h1 class="text-lg-center">{{ author.first_name }} {{ author.last_name }} books:</h1>
        <ul v-for="book in books">
            <li>
                <router-link :to="{name: 'book', params: {id: book.id}}">
                    {{ book.title }}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        created() {
            this.getAuthor();
        },

        data() {
            return {
                books: [],
                author: {
                    first_name: '',
                    last_name: '',
                },
                bookEndpoint: '/api/authors/'
            };
        },

        methods: {
            getAuthor() {
                let id = this.$route.params.id;

                axios.get(this.bookEndpoint + id)
                    .then(response => {
                        let data = response.data;
                        this.author = data.attributes;
                        this.books = data.attributes.books;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
        }
    }
</script>