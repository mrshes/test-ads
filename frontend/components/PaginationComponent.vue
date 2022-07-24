<template>
        <div class="text-center" v-if="total">
            <v-pagination
                    :color="color"
                    circle
                    :value="current_page"
                    :length="last_page"
                    :total-visible="8"
                    @input="go"
            ></v-pagination>
        </div>
</template>

<script>
    export default {
        name: "PaginationComponent",
        data(){
            return{

            }
        },
        props: {
            current_page: Number,
            from: Number,
            last_page: Number,
            per_page: Number,
            to: Number,
            total: Number,
            color:{
                type: String,
                default: '#147736'
            }
        },
        methods: {
            go(number) {
                this.$emit('go', number);
            }
        },
    }
</script>

<style scoped>

</style>
