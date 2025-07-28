<template>
    <!-- <div class="col-md-3">
        <div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="card-title">{{ title }}</h5>
                        <h2>{{ count }}</h2>
                    </div>
                    <i :class="['ml-auto', 'icon' , icon ]"></i>
                </div>
            </div>
        </div>

    </div> -->
    <div :class="['stats-card', className]">
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <h4 class="card-count">{{ count }}</h4>
            <i :class="['icon', icon ]"></i>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        title:{
            type:String,
            required:true,
        },
        count: {
            type:Number,
            required:true,
        },
        icon:{
            type:String,
            required:true,
        },
        className:{
            type:String,
            required:true,
        },
    },
    // props: {
    //     title:String,
    //     count:Number,
    //     icon:String,
    //     class:String,
    // },
} ;
</script>
<style scoped>
    .stats-card {
        padding: 1rem;
        border-radius: 0.5rem;

        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        color: #807f8d;
    }
    .card-count{
        color: black;
    }
    .icon{
        font-size: 2rem;
        margin-top: 0.5rem;
    }
</style>
