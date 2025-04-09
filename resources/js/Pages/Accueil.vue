<template>



    <AccueilNavigation>
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <!-- <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"> 
                                            <p v-if="user.name">
                                                Bienvenue, {{ user.name }} !
                                                
                                                <form class="contact-form row" @submit.prevent="submitForm">
                                                    <div class="form-field col-lg-12">
                                                        <input class="submit-btn" type="submit" value="Deconnexion">
                                                    </div>
                                                </form>
                                                
                                            </p>                                            
                                            <p v-else>
                                                <a href="/connexion">Se connecter</a>
                                            </p>

                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
           
            
    </AccueilNavigation>

</template>

<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({});

    const submitForm = () => {
        form.post('/deconnexion');
    };

    const props = defineProps({
        sessionData: Object,
        user: Object
    })

</script>
<script>
export default {

}
</script>

