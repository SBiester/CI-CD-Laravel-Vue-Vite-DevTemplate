<template>
    <div class="dashboard-container">
        <!--Header-->
        <Header />
        <div class="main-layout">
            <!--Sidebar-->
            <Sidebar />
            <div class="contento">
                <div class="headero">
                    <!--Main Content-->
                    <div class="main-content">
                        <!--IdeaForm-->
                        <SubmitIdeaForm />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from './Sidebar.vue';
import Header from './Header.vue';
import SubmitIdeaForm from './SubmitIdeaForm.vue';

export default {
    name: "SubmitIdea",
    components: {
        Sidebar,
        Header,
        SubmitIdeaForm,
    }
}
</script>


