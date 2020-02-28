<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <data-table :users="filteredUsers" class="table"></data-table>
            </div>
        </div>
    </div>
</template>

<script>
    import DataTable from './DataTable.vue'
    export default {
        components:{
            DataTable
        },
        data(){
          return{
              users: [],
              search: ''
          }
        },
        computed:{
            filteredUsers: function () {
                let self = this
                let search = self.search.toLowerCase()
                return self.users.filter(function (comments) {
                    return comments.name.toLowerCase().indexOf(search) !== -1 ||
                            comments.email.toLowerCase().indexOf(search) !== -1
                })
            }
        },
        mounted() {
            let vm = this;
            $.ajax({
                url: '/api/users/',
                success(res){
                    vm.users = res;
                }
            });
            console.log('Component mounted.')
        }
    }
</script>
