<template>


    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Etablir un proforma</h4>





                <div class="modal fade" id="Rechercherproforma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="col">
                                    <div class="mb-3">
                                        <div class="wrapper--input">
                                            <input type="text" v-model="searchNumProforma" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="RECHERCHER UN NUMERO DE PROFORMA">
                                            <div class="search">
                                                <div v-for="result_regex_proforma in result_regexp_proforma" :key="result_regex_proforma.id"
                                                    class="container-designation-search" @click="(event) => selectNumProforma(result_regex_proforma, event)">
                                                    <button class="btn" data-bs-dismiss="modal">
                                                        <b>{{ result_regex_proforma.numProforma }}</b>
                                                        <span class="ms-2">
                                                            (Date: {{ result_regex_proforma.date }})
                                                        </span>
                                                        <span class="ms-2">
                                                            (Heure: {{ result_regex_proforma.heure }})
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Rechercherproforma">Rechercher proforma</button>
                </div>





                <div class="ms-auto">
                    <button @click="validerFormulaire" class="btn btn-primary">Valider</button>
                </div>
                <div class="ms-auto">
                    <!-- <a :href="'/impression-facturation-proformas/' + numProforma">imprime</a> -->
                    <!-- <button @click="imprimer" class="btn btn-primary">Imprimer proforma</button> -->
                </div>
                <div class="ms-2 dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajouter</button></li>
                        <li><button class="dropdown-item" @click="enregistrer">Enregistrer</button></li>
                        <a class="btn" :href="'/impression-facturation-proformas/' + numProforma">imprime</a>
                        <li><button class="dropdown-item" @click="supprimerProforma">Supprimer</button></li>
                        <li><button class="dropdown-item" @click="nouveau">Nouveau</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...

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
                                    @click="selectArticle(result_regex)">
                                    <b>{{ result_regex.DESIGNATION }}</b>
                                    <span class="ms-2">
                                        (Principal: {{ result_regex.QTE_STOCK }},
                                        Dépôt 1: {{ result_regex.stock1 ? result_regex.stock1.QTE_STOCK : 'N/A' }},
                                        Dépôt 2: {{ result_regex.stock2 ? result_regex.stock2.QTE_STOCK : 'N/A' }},
                                        Dépôt 3: {{ result_regex.stock3 ? result_regex.stock3.QTE_STOCK : 'N/A' }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                            </div>
                        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive row">

                <form class="row g-3 my-3" style="background-color: #e0f7ff;">
                    <div class="col-md-4">
                        <label for="numProforma" class="form-label">N° de proforma</label>
                        <input type="text" class="form-control" id="numProforma" v-model="numProforma" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" v-model="date">
                    </div>
                    <div class="col-md-4">
                        <label for="heure" class="form-label">Heure</label>
                        <input type="time" class="form-control" id="heure" v-model="heure">
                    </div>
                    <div class="col-md-6">
                        <label for="typeProforma" class="form-label">Type proforma</label>
                        <select id="typeProforma" class="form-select" v-model="typeProforma">
                            <option selected>Choisir...</option>
                            <option selected>SOCIETE</option>
                            <option selected>COMPTANT</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="typeFiscal" class="form-label">Type fiscal</label>
                        <select id="typeFiscal" class="form-select" v-model="typeFiscal">
                            <option selected>NORMAL</option>
                            <option selected>DIRECT</option>
                            <option selected>EXONERE</option>
                            <option selected>TVA+PRECPT</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="client" class="form-label">Client</label>
                        <select id="client" class="form-select" v-model="client">
                            <option selected>Choisir...</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="acheteur" class="form-label">Acheteur</label>
                        <input type="text" class="form-control" id="acheteur" v-model="acheteur">
                    </div>
                    <div class="col-md-4">
                        <label for="commercial" class="form-label">Commercial</label>
                        <select id="commercial" class="form-select" v-model="commercial">
                            <option selected>COMPTOIR</option>
                            <option selected>EDOUARD G.</option>
                            <option selected>EMMANUEL PAUL DIDIER</option>
                            <option selected>FOKO DANIEL</option>
                            <option selected>KAMENI</option>
                            <option selected>MAMBOU JOSEPH</option>
                            <option selected>MUO JOEL</option>
                            <option selected>MANKO DONALD</option>
                            <option selected>PERSONEL SEMEM</option>
                            <option selected>TAYOU RIGOBERT</option>
                            <option selected>TCHAMADOU MARCIAL</option>
                            <option selected>VTE INTERNATIONALE</option>
                            <option selected>VENTE INTERNE</option>
                            <option selected>WAFO</option>
                            <option selected>WANDA FRANCIS</option>
                            <option selected>YAMANGA DUPLEX</option>
                            <option selected>YOGHO</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="vendeur" class="form-label">Vendeur</label>
                        <select id="vendeur" class="form-select" v-model="vendeur">
                            <option selected>WANDA FRANCIS</option>
                            <option selected>GERVAIS</option>
                            <option selected>HERVE</option>
                            <option selected>KAMENI</option>
                            <option selected>LINE</option>
                            <option selected>MARCEL</option>
                            <option selected>ROMEO</option>
                            <option selected>STEPHANIE</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="da" class="form-label">DA</label>
                        <input type="text" class="form-control" id="da" v-model="da">
                    </div>
                </form>


                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="p-1" style="width: 40%;">Désignation</th>
                                <th class="p-1" style="width: 12%;">PU</th>
                                <th class="p-1" style="width: 12%;">QTÉ</th>
                                <th class="p-1" style="width: 12%;">Remise</th>
                                <th class="p-1" style="width: 12%;">PT</th>
                                <th class="p-1" style="width: 12%;">UV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(article, index) in articlesSelectionnes" :key="index">
                                <td class="p-0"><input type="text" class="form-control form-control-sm border-0" v-model="article.DESIGNATION" disabled></td>
                                <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.PU" style="width: 100%;"></td>
                                <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.QTE" style="width: 100%;"></td>
                                <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.REMISE" style="width: 100%;"></td>
                                <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.PT" readonly style="width: 100%;"></td>
                                <td class="p-0"><input type="text" class="form-control form-control-sm border-0" v-model="article.UV" style="width: 100%;"></td>
                                <td class="p-0">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalSuppression">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <!-- Modal -->
                    <div class="modal fade" id="ModalSuppression" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmez la suppression</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-danger"  @click="supprimerArticle(index)" data-bs-dismiss="modal"> OUI SUPPRIMER</button>
                        </div>
                        </div>
                    </div>
                    </div>


                </div>


                <!-- recapitulatif facture debut -->
                <div class="table-responsive mt-2" style="background-color: #e6f9e6;">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="p-1" style="background-color: #ccffcc;">Montant Net HT</th>
                                <th class="p-1" style="background-color: #ccffcc;">TVA (19.25%)</th>
                                <th class="p-1" style="background-color: #ccffcc;">Montant Net TTC</th>
                                <th class="p-1" style="background-color: #ccffcc;">Précompte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-1" style="background-color: #ccffcc;">{{ montantNetHT.toFixed(2) }}</td>
                                <td class="p-1" style="background-color: #ccffcc;">{{ montantTVA.toFixed(2) }}</td>
                                <td class="p-1" style="background-color: #ccffcc;">{{ montantNetTTC.toFixed(2) }}</td>
                                <td class="p-1" style="background-color: #ccffcc;">
                                    <input type="number" class="form-control form-control-sm" v-model="precompte">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- recapitulatif facture fin -->

            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch, onMounted } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';


// recuperetion des valeur du controller
const props = defineProps({
  proformas: Array,
  stockLists: Object,
  articlesProforma: Array,
  numProforma: String
});
// Affichage dans la console
console.log('Proformas reçues du ccccontrôleur:', props.articlesProforma);

const state = reactive({
    selectedProforma: null,
    articles: [],
    stockLists: props.stockLists,
    proformas: props.proformas
});
///////////////////////////////////////////


const now = new Date();
const date = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.date || now.toISOString().split('T')[0]);
const heure = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.heure || now.toTimeString().split(' ')[0]);

const numProforma = computed(() => {
    const cleanDate = date.value.replace(/-/g, '');
    const cleanTime = heure.value.replace(/:/g, '');
    return cleanDate + cleanTime;
});

const typeProforma = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.typeProforma || 'Choisir...');
const typeFiscal = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.typeFiscal || 'Choisir...');
const client = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.client || 'Choisir...');
const acheteur = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.acheteur || '');
const commercial = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.commercial || 'Choisir...');
const vendeur = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.vendeur || 'Choisir...');
const da = ref(props.proformas.find(proforma => proforma.numProforma === props.numProforma)?.da || '');

const articlesSelectionnes = ref([]);

const form = useForm({
    numProforma: '',
    date: '',
    heure: '',
    typeProforma: '',
    typeFiscal: '',
    client: '',
    acheteur: '',
    commercial: '',
    vendeur: '',
    da: ''
});

        watch([date, heure], () => {
            // Le numProforma sera automatiquement mis à jour grâce au computed
        });

        const validerFormulaire = () => {
            form.numProforma = numProforma.value;
            form.date = date.value;
            form.heure = heure.value;
            form.typeProforma = typeProforma.value;
            form.typeFiscal = typeFiscal.value;
            form.client = client.value;
            form.acheteur = acheteur.value;
            form.commercial = commercial.value;
            form.vendeur = vendeur.value;
            form.da = da.value;

            console.log( form.date);


            form.post('/facturation-proformat', {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    console.log(page.props.message);
                },
            });
        };

        onMounted(() => {
            // Ajouter les articlesProforma dans articlesSelectionnes lors du montage du composant
            articlesSelectionnes.value = props.articlesProforma.map(article => ({
                DESIGNATION: article.designation,
                PU: article.pu,
                QTE: article.qte,
                REMISE: article.remise,
                UV: article.uv,
                get PT() {
                    return (this.PU * this.QTE) * (100 - this.REMISE) / 100;
                }
            }));

            // Mettre à jour la date et l'heure toutes les secondes
            // setInterval(() => {
            //     const now = new Date();
            //     date.value = now.toISOString().split('T')[0];
            //     heure.value = now.toTimeString().split(' ')[0];
            // }, 1000);
        });

    // recherche article debut
        const searchDesignation = ref('');
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
    // ///////////////////// recherche article fin

        // recherche numProforma
            const searchNumProforma = ref('');

            let result_regexp_proforma = ref([]);

            watch(searchNumProforma, (newVal) => {

                let regex = RegExp(`^${newVal}`);
                let regexContains = RegExp(newVal);

                let new_result_regexp_proforma = props.proformas.filter(item => regex.test(item.numProforma) || regexContains.test(item.numProforma));

                // Trier les résultats pour afficher d'abord ceux qui commencent par l'expression recherchée, puis par ordre alphabétique
                new_result_regexp_proforma.sort((a, b) => {
                    if (regex.test(a.numProforma)) {
                        return regex.test(b.numProforma) ? 0 : -1;
                    }
                    if (regex.test(b.numProforma)) {
                        return 1;
                    }
                    return a.numProforma.localeCompare(b.numProforma);
                });

                result_regexp_proforma.value = newVal == 0 ? [] : new_result_regexp_proforma;
            });
        ////////////////////////////////////



        //recherche proforma
        const selectNumProforma = async (proforma, event) => {
            event.preventDefault();
            event.stopPropagation();

            try {
                // Effectuer la requête GET avec numProforma
                const response = await axios.get(`/proforma/${proforma.numProforma}`);
                console.log("Récupération réussie", response.data);

                // Mettre à jour l'état du composant avec les nouvelles données
                state.articles = response.data.articlesProforma;
                state.selectedProforma = proforma.numProforma;  // Mettre à jour le numéro de la proforma sélectionnée
                state.stockLists = response.data.stockLists;  // Mettre à jour la liste des stocks
                state.proformas = response.data.proformas;  // Mettre à jour la liste des proformas

                // Mettre à jour les variables réactives (ref) avec les nouvelles données
                const proformaData = response.data.proformas.find(p => p.numProforma === proforma.numProforma);

                // Mettre à jour les ref avec les nouvelles données de la proforma sélectionnée
                date.value = proformaData?.date || now.toISOString().split('T')[0];
                heure.value = proformaData?.heure || now.toTimeString().split(' ')[0];

                typeProforma.value = proformaData?.typeProforma || 'Choisir...';
                typeFiscal.value = proformaData?.typeFiscal || 'Choisir...';
                client.value = proformaData?.client || 'Choisir...';
                acheteur.value = proformaData?.acheteur || '';
                commercial.value = proformaData?.commercial || 'Choisir...';
                vendeur.value = proformaData?.vendeur || 'Choisir...';
                da.value = proformaData?.da || '';

                // Mettre à jour numProforma si nécessaire
                numProforma.value = `${date.value.replace(/-/g, '')}${heure.value.replace(/:/g, '')}`;

                // Mettre à jour la liste des articles sélectionnés
                articlesSelectionnes.value = response.data.articlesProforma.map(article => ({
                    DESIGNATION: article.designation,
                    PU: article.pu,
                    QTE: article.qte,
                    REMISE: article.remise,
                    UV: article.uv,
                    get PT() {
                        return (this.PU * this.QTE) * (100 - this.REMISE) / 100;
                    }
                }));

            } catch (error) {
                console.error("Erreur lors de la récupération des données:", error);
            }
        };
        /////////////////



    const montantNetHT = computed(() => {
        return articlesSelectionnes.value.reduce((total, article) => total + article.PT, 0);
    });

    const TVA = 19.25;

    const montantTVA = computed(() => {
        return montantNetHT.value * (TVA / 100);
    });

    const montantNetTTC = computed(() => {
        return montantNetHT.value + montantTVA.value;
    });

        // const precompte = ref(0);
            const precompte = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].precompte : '');

        //seclectionne un article de la recherche
            const selectArticle = (article) => {
                // Logique pour sélectionner l'article
                console.log("Article sélectionné:", article);

                // Fermer le modal
                    const modal = document.getElementById('staticBackdrop');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                // Ajouter l'article sélectionné au tableau
                    const nouvelArticle = {
                        DESIGNATION: article.DESIGNATION,
                        PU: article.PU || 0,
                        QTE: 1,
                        REMISE: 0,
                        UV: article.UV || '',
                        get PT() {
                            return (this.PU * this.QTE) * (100 - this.REMISE) / 100;
                        }
                    };

                    articlesSelectionnes.value.push(nouvelArticle);
                //////////////

                // Mettre à jour le modèle de l'input du modal
                searchDesignation.value = '';

                // Afficher le tableau mis à jour dans la console
                console.log("Articles sélectionnés:", articlesSelectionnes.value);

                // Création des variables dynamiques avec les formules de calcul
                const montantNetHT = computed(() => {
                    return articlesSelectionnes.value.reduce((total, article) => total + article.PT, 0);
                });

                const TVA = 19.25;

                const montantTVA = computed(() => {
                    return montantNetHT.value * (TVA / 100);
                });

                const montantNetTTC = computed(() => {
                    return montantNetHT.value + montantTVA.value;
                });


                // Affichage des valeurs calculées dans la console pour vérification
                    watch([montantNetHT, montantTVA, montantNetTTC, precompte], () => {
                        console.log("Montant net HT:", montantNetHT.value);
                        console.log("TVA (19.25%):", montantTVA.value);
                        console.log("Montant net TTC:", montantNetTTC.value);
                        console.log("Précompte:", precompte.value);
                    });
            };
        //////////////////////////////

        // Fonction pour envoyer les articles au contrôleur
            const enregistrer = () => {

                // Préparation des données à envoyer
                const donnees = {
                    articles: articlesSelectionnes.value.map(article => ({
                        designation: article.DESIGNATION,
                        pu: article.PU,
                        qte: article.QTE,
                        remise: article.REMISE,
                        uv: article.UV
                    })),
                    codeProforma: numProforma.value,
                    precompte: precompte.value,
                };

                // Envoi des données à la route
                axios.post('/enregistrer', donnees)
                    .then(response => {
                        console.log('Données enregistrées avec succès:', response.data);
                        // Ajoutez ici le code pour gérer la réponse (par exemple, afficher un message de succès)
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'enregistrement des données:', error);
                        // Ajoutez ici le code pour gérer l'erreur (par exemple, afficher un message d'erreur)
                    });

                // console.log("yeyeeyfffff"+numProforma.value);
                // console.log("Contenu des articles :");
                // donnees.articles.forEach((article, index) => {
                //     console.log(`Article ${index + 1}:`, article);
                // });
            };
        ///////////////////

        // Fonction pour réinitialiser toutes les variables
            const nouveau = () => {
                typeProforma.value = 'Choisir...';
                typeFiscal.value = 'Choisir...';
                client.value = 'Choisir...';
                acheteur.value = '';
                commercial.value = 'Choisir...';
                vendeur.value = 'Choisir...';
                da.value = '';
                articlesSelectionnes.value = [];
                searchDesignation.value = '';
                precompte.value = 0;
                setInterval(() => {
                    const now = new Date();
                    date.value = now.toISOString().split('T')[0];
                    heure.value = now.toTimeString().split(' ')[0];
                }, 1000);
            };
        // /////////////////

        // Fonction pour supprimer un article du tableau
            const supprimerArticle = (index) => {
                articlesSelectionnes.value.splice(index, 1);
            };
        ////////////////

        // /////
        // Fonction pour supprimer une proforma
            const supprimerProforma = (numProforma) => {
                axios.delete(`/supprimer/${numProforma}`)
                    .then(response => {
                        console.log('Proforma supprimée avec succès:', response.data);
                        // Ajoutez ici le code pour gérer la réponse (par exemple, afficher un message de succès)
                    })
                    .catch(error => {
                        console.error('Erreur lors de la suppression de la proforma:', error);
                        // Ajoutez ici le code pour gérer l'erreur (par exemple, afficher un message d'erreur)
                    });
            };
        // ///////////////////////


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

