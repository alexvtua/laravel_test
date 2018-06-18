<template>
    <div class="books">
        <h1>Authors</h1>
        <table class="table-bordered">
            <thead>
            <tr>
                <th>Author</th>
                <th>Books</th>
            </tr>
            </thead>
        <tbody>
        <tr v-for="author in authors" :key="author.id">
            <td>
                <router-link :to="{name: 'author', params: {id: author.id}}">
                    {{author.first_name}} {{author.last_name}}
                </router-link>
            </td>
            <td>
            <ul v-for="book in author.books" :key="book.id">
                <li>
                    <router-link :to="{name: 'book', params: {id: book.id}}">
                        {{ book.title }}
                    </router-link>
                </li>
            </ul>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        created() {
            this.getAuthors();
        },

        data() {
            return {
                books: [],
                authors: {
                    id: '',
                    first_name: '',
                    last_name: '',
                },
                bookEndpoint: '/api/authors/'
            };
        },

        methods: {
            getAuthors() {
                axios.get(this.bookEndpoint)
                    .then(response => {
                        let data = response.data;
                        this.authors = data.data;
                        this.books = data.data.books;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
        }
    }
</script>