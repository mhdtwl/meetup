<template>
    <table class="table is-bordered data-table">
        <thead>
        <tr>
            <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                :style="'width:'+column.width+';'+'cursor:pointer;'">
                {{column.label}}
            </th>
        </tr>
        </thead>
        <slot></slot>
    </table>
</template>
<style>
    input.input{
        /* display: block; */
        width: 100%;
        height: calc(1.6em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%;
    }
    div.select > select{
        justify-content: flex-end !important;
        height: calc(1.2em + 0.75rem + 2px);
        padding: 0.175rem 0.75rem;
        margin-bottom: 1rem;
        border: 1px solid #ced4da;
    }

    div.tableFilters {
        flex-wrap: wrap;
        display: flex;
        justify-content: space-between;
    }
    nav.pagination {
        justify-content: flex-end !important;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }
    nav.pagination  > span {
        text-align: -webkit-match-parent;
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
    }
    nav.pagination  > a {
        text-align: -webkit-match-parent;
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #3490dc;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    nav.pagination  > a.pagination-previous
    {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    nav.pagination  > a.pagination-next
    {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    nav.pagination  > a:hover {
        cursor: pointer;
    }
</style>
<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>