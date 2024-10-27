<template>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">ARTICLES EN STOCK</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stock</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive row">
                <div class="col-lg-6 col-xl-12 col-sm-12 col">
                    <div class="badge-box">
                        <label class="badge badge-primary" v-for="link in stockLists.links" :key="link.id">
                            <Link class="badge rounded-pill bg-success p-1" :href="link.url"> {{ link.label }} </Link>
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                    <div class="wrapper--input">
                        <input type="text" v-model="searchDesignation"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="RECHERCHER UN ARTICLE">
                        <div class="search">
                            <div v-for="result_regex in result_regexp" :key="result_regex.id"
                                class="container-designation-search">
                                <Link :href="`/ajout-article-${result_regex.CODE}`">
                                <b>{{ result_regex.DESIGNATION }}</b>
                                <span class="ms-2">
                                    (Principal: {{ result_regex.QTE_STOCK }},
                                    Dépôt 1: {{ result_regex.stock1 ? result_regex.stock1.QTE_STOCK : 'N/A' }},
                                    Dépôt 2: {{ result_regex.stock2 ? result_regex.stock2.QTE_STOCK : 'N/A' }},
                                    Dépôt 3: {{ result_regex.stock3 ? result_regex.stock3.QTE_STOCK : 'N/A' }})
                                </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Code</th>
                            <th>Dépôt principal</th>
                            <th>Dépôt 1</th>
                            <th>Dépôt 2</th>
                            <th>Dépôt 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="stockList in stockLists.data" :key="stockList.id">
                            <td>
                                <div class="d-inline-block align-middle">
                                    <div class="d-inline-block">
                                        <h6>{{ stockList.DESIGNATION }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ stockList.CODE }}</td>
                            <td>{{ stockList.DEPOT }} {{ stockList.QTE_STOCK }}</td>
                            <td>{{ stockList.stock1 ? stockList.stock1.DEPOT : 'N/A' }}
                                {{ stockList.stock1 ? stockList.stock1.QTE_STOCK : 'N/A' }}</td>
                            <td>{{ stockList.stock2 ? stockList.stock2.DEPOT : 'N/A' }}
                                {{ stockList.stock2 ? stockList.stock2.QTE_STOCK : 'N/A' }}</td>
                            <td>{{ stockList.stock3 ? stockList.stock3.DEPOT : 'N/A' }}
                                {{ stockList.stock3 ? stockList.stock3.QTE_STOCK : 'N/A' }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Code</th>
                            <th>Dépôt principal</th>
                            <th>Dépôt 1</th>
                            <th>Dépôt 2</th>
                            <th>Dépôt 3</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue'



// recherche article debut
const searchDesignation = ref('');

const props = defineProps({
    stockLists: Object,
});

let result_regexp = ref([]);

        watch(searchDesignation, (newVal) => {

            let regex = RegExp(`^${newVal.toUpperCase()}`);
            let regexContains = RegExp(newVal.toUpperCase());

            let new_result_regexp = props.stockLists.data.filter(item => regex.test(item.DESIGNATION.toUpperCase()) || regexContains.test(item.DESIGNATION.toUpperCase()));

            // Trier les résultats pour afficher d'abord ceux qui commencent par l'expression recherchée, puis par ordre alphabétique
            new_result_regexp.sort((a, b) => {
                if (regex.test(a.DESIGNATION.toUpperCase())) {
                    return regex.test(b.DESIGNATION.toUpperCase()) ? 0 : -1;
                }
                if (regex.test(b.DESIGNATION.toUpperCase())) {
                    return 1;
                }
                return a.DESIGNATION.localeCompare(b.DESIGNATION);
            });


    result_regexp.value = newVal == 0 ? [] : new_result_regexp;
});
// recherche article fin
</script>


<script>

export default {
    props: {
        stockLists: Object,
    },
    components: {},
    data() {
        return {}
    },
    methods: {
        search() { }
    }
}
</script>


<style lang="scss">
    #content-to-pdf {
        width: 100%;
        /* Assurez-vous que le contenu s'adapte à la largeur */
        max-width: 210mm;
        /* Largeur maximale pour A4 */
    }

    .wrapper--input {
        position: relative;

        .input {}

        .search {
            position: absolute;
            top: 100%;
            width: 100%;
            max-height: 300px; // Hauteur maximale pour la barre de défilement
            overflow-y: auto; // Ajoute une barre de défilement verticale si nécessaire
            background-color: #fff;
            border: solid 1px red;

            .container-designation-search {
                display: flex;
                align-items: center;
                padding: 0.2rem;

                &:hover {
                    background: rgb(216, 216, 230);
                }
            }
        }
    }
</style>
