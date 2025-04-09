<template>
    <div class="page-breadcrumb mb-5">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">STOCK GLOBAL DES ARTICLES</h4>
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
    <div>
        <div class="row text-center">
            <div class="col-3"> {{ nom }} </div>
            <!-- <div class="col"> CODE <br> {{ code }} </div> -->
            <div class="col btn"
                :class="stock_akwa < 1 ? 'btn-danger' : 'btn-primary'">
                AKWA <br> {{ stock_akwa }}
            </div>
            <div class="col btn"
                :class="stock_bafoussam < 1 ? 'btn-danger' : 'btn-primary'">
                BAFOUSSAM <br> {{ stock_bafoussam }}
            </div>
            <div class="col btn"
                :class="stock_camair < 1 ? 'btn-danger' : 'btn-primary'">
                CAMAIR <br> {{ stock_camair }}
            </div>
            <div class="col btn"
                :class="stock_mokolo < 1 ? 'btn-danger' : 'btn-primary'">
                MOKOLO <br> {{ stock_mokolo }}
            </div>
            <div class="col btn"
                :class="stock_olezoa < 1 ? 'btn-danger' : 'btn-primary'">
                OLEZOA <br> {{ stock_olezoa }}
            </div>
            <div class="col btn"
                :class="stock_junior < 1 ? 'btn-danger' : 'btn-primary'">
                JUNIOR <br> {{ stock_junior }}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive row">
                <!-- <div class="col-lg-6 col-xl-12 col-sm-12 col">
                    <div class="badge-box">
                        <label class="badge badge-primary" v-for="link in stockLists.links" :key="link.id">
                            <Link class="badge rounded-pill bg-success p-1" :href="link.url"> {{ link.label }} </Link>
                        </label>
                    </div>
                </div> -->
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
                                    class="container-designation-search"
                                    @click="rechercheArticle(result_regex)">
                                        <b>{{ result_regex.DESIGNATION }}</b>
                                        <span class="ms-2">
                                            (Principal: {{ result_regex.QTE_STOCK }},
                                            <!-- Dépôt 1: {{ result_regex.stock1 ? result_regex.stock1.QTE_STOCK : 'N/A' }},
                                            Dépôt 2: {{ result_regex.stock2 ? result_regex.stock2.QTE_STOCK : 'N/A' }},
                                            Dépôt 3: {{ result_regex.stock3 ? result_regex.stock3.QTE_STOCK : 'N/A' }} -->
                                            )
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <!-- <th>AKWA <hr> BASSA </th> -->

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
                            <!-- <td>
                                <span class="badge rounded-pill bg-success p-1 me-2">{{ stockList ? stockList.QTE_STOCK : 'N/A' }}</span>
                                <span class="badge rounded-pill bg-primary p-1 ">{{ stockList ? stockList.QTE_STOCK : 'N/A' }}</span>
                            </td> -->

                        </tr>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>AKWA</th>
                            <th>BAFOUSSAM</th>
                            <th>CAMAIR</th>
                            <th>JUNIOR</th>
                            <th>MOKOLO</th>
                            <th>OLEZOA </th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue'
import axios from 'axios';




// recherche article debut
        const searchDesignation = ref('');

        const nom = ref('nom');
        const code = ref('code');
        const stock_akwa = ref('stock_akwa');
        const stock_bafoussam = ref('stock_bafoussam');
        const stock_camair = ref('stock_camair');
        const stock_mokolo = ref('stock_mokolo');
        const stock_olezoa = ref('stock_olezoa');
        const stock_junior = ref('stock_junior');

        const props = defineProps({
            stockLists: Object,
            // bafoussams: Object,
            // camairs: Object,
            // mokolos: Object,
            // olezoas: Object,
            // juniors: Object,
            errors: Object,
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


const rechercheArticle = async (article) => {
    try {
        // Afficher le code de l'article dans la console
        console.log(`Recherche pour le code article: ${article.CODE}`);

        // URL de l'API pour récupérer les quantités
        const apiUrl = `/get-stock/${article.CODE}`;

        // Effectuer la requête GET avec Axios
        const response = await axios.get(apiUrl);

        // Vérifier si la requête a réussi et les données sont disponibles
        if (response.status === 200 && response.data) {
            // Extraire les données de la réponse
            const quantites = response.data;

            // Afficher les quantités dans la console
            nom.value = article.DESIGNATION;
            code.value = article.CODE;
            stock_akwa.value = quantites.stock_akwa;
            stock_bafoussam.value = quantites.stock_bafoussam;
            stock_camair.value = quantites.stock_camair;
            stock_mokolo.value = quantites.stock_mokolo;
            stock_olezoa.value = quantites.stock_olezoa;
            stock_junior.value = quantites.stock_junior;
            console.log(`Quantités pour l'article ${article.CODE}:`, quantites);

            return quantites; // Retourner les quantités si nécessaire
        } else {
            console.error(`Aucune donnée trouvée pour l'article avec le code ${article.CODE}`);
            return null;
        }
    } catch (error) {
        // Gérer les erreurs
        console.error(`Erreur lors de la récupération des quantités pour l'article ${article.CODE}:`, error.message);
    }

}

</script>


<script>

export default {
    props: {
        stockLists: Object,
        // bafoussams: Object,
        // camairs: Object,
        // mokolos: Object,
        // olezoas: Object,
        // juniors: Object,
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
