
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
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
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
    import TableTemplate from './TableTemplate.vue';

    export default {
        extends:TableTemplate,
        data() {
            let end_point_url = '/api/users'
            let columns = [
                {width: '50%', label: 'Name', name: 'name' },
                {width: '50%', label: 'Email', name: 'email'},
            ];

            let sortOrders = {};
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                endPointUrl: end_point_url,
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
                    dir: 'desc',
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
        }
    };
</script>
