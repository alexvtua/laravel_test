<template>
    <div class="books">
        <h1>Books</h1>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>
                    <router-link :to="{name: 'book', params: {id: book.id}}">
                        {{ book.title }}
                    </router-link>
                </td>
                <td>
                    <router-link :to="{name: 'author', params: {id: book.author.id}}">
                        {{book.author.first_name}}
                    </router-link>
                </td>
                <td>
                    <router-link :to="{name: 'author', params: {id: book.author.id}}">
                        {{book.author.last_name}}
                    </router-link>
                </td>
            </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getBooks(pagination.prevPageUrl)"
                    @next="getBooks(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>
    import Datatable from './Datatable.vue';
    import Pagination from './Pagination.vue'

    export default {
        components: {datatable: Datatable, pagination: Pagination},
        created() {
            this.getBooks();
        },
        data() {
            let sortOrders = {};

            let columns = [
                {width: '33%', label: 'Title', name: 'title'},
                {width: '33%', label: 'First Name', name: 'authors.first_name'},
                {width: '33%', label: 'Last Name', name: 'authors.last_name'}
            ];

            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                books: [],
                columns: columns,
                sortKey: 'title',
                sortOrders: sortOrders,
                tableData: {
                    sort: 'title',
                    direction: 'ASC',
                },
                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    lastPageUrl: '',
                    nextPageUrl: '',
                    prevPageUrl: '',
                    from: '',
                    to: ''
                },
            }
        },
        methods: {
            getBooks(url = '/api/books') {
                axios.get(url, {params: this.tableData})
                    .then(response => {
                        let data = response.data;
                        this.books = data.data;
                        this.configPagination(data.pagination);
                        this.$router.push({
                            path: '/',
                            query: {
                                page: data.pagination.current_page,
                                sort: this.tableData.sort,
                                direction: this.tableData.direction
                            }
                        });
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.sort = key;
                this.tableData.direction = this.sortOrders[key] === 1 ? 'ASC' : 'DESC';
                this.getBooks();
            },
        }
    };
</script>