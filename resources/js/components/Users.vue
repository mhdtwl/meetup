<template>
    <div class="items">
        <div class="tableFilters">
            <input class="input" type="text" v-model="tableData.search" placeholder="Search Table"
                   @input="getItems()">

            <div class="control">
                <div class="select">
                    <select v-model="tableData.length" @change="getItems()">
                        <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                    </select>
                </div>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" class="table-bordered table-hover dataTable" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{item.name}}</td>
                <td>{{item.email}}</td>
            </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getItems(pagination.prevPageUrl)"
                    @next="getItems(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>


    import MyDatatable from './MyDatatable.vue';
    import Pagination from './Pagination.vue';


    export default {
        components: { datatable: MyDatatable, pagination: Pagination },
        created() {
            this.getItems();
        },
        data() {
            let sortOrders = {};

            let columns = [
                {width: '50%', label: ' ↕   Name', name: 'name' },
                {width: '50%', label: ' ↕   Email', name: 'email'},
            ];

            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                items: [],
                columns: columns,
                sortKey: columns[0],
                sortOrders: sortOrders,
                perPage: ['10', '20', '30'],
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'asc',
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
            getItems(url = '/api/users') {
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(response => {
                        let data = response.data;
                        if (this.tableData.draw == data.draw) {
                            this.items = data.data.data;
                            this.configPagination(data.data);
                        }
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
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getItems();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
        }
    };
</script>
