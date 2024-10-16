<template>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Etablir un proforma</h4>
                <div class="ms-auto">
                    <button @click="validerFormulaire" class="btn btn-primary">Valider</button>
                </div>
            <div class="ms-2 dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Actions
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ajouter</button></li>
                    <li><button class="dropdown-item" @click="enregistrer">Enregistrer</button></li>
                    <li><button class="dropdown-item" @click="supprimer">Supprimer</button></li>
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

                <form class="row g-3">
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
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="typeFiscal" class="form-label">Type fiscal</label>
                        <select id="typeFiscal" class="form-select" v-model="typeFiscal">
                            <option selected>Choisir...</option>
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
                            <option selected>Choisir...</option>
                            <!-- Ajouter les options ici -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="vendeur" class="form-label">Vendeur</label>
                        <select id="vendeur" class="form-select" v-model="vendeur">
                            <option selected>Choisir...</option>
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
                            <td class="p-0"><input type="text" class="form-control form-control-sm border-0" v-model="article.DESIGNATION"></td>
                            <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.PU" style="width: 100%;"></td>
                            <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.QTE" style="width: 100%;"></td>
                            <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.REMISE" style="width: 100%;"></td>
                            <td class="p-0"><input type="number" class="form-control form-control-sm border-0" v-model="article.PT" readonly style="width: 100%;"></td>
                            <td class="p-0"><input type="text" class="form-control form-control-sm border-0" v-model="article.UV" style="width: 100%;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="table-responsive mt-2">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="p-1">Montant Net HT</th>
                            <th class="p-1">TVA (19.25%)</th>
                            <th class="p-1">Montant Net TTC</th>
                            <th class="p-1">Précompte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-1">{{ montantNetHT.toFixed(2) }}</td>
                            <td class="p-1">{{ montantTVA.toFixed(2) }}</td>
                            <td class="p-1">{{ montantNetTTC.toFixed(2) }}</td>
                            <td class="p-1">
                                <input type="number" class="form-control form-control-sm" v-model="precompte">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>




            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';


// recuperetion des valeur du controller
// Récupération des valeurs du contrôleur
const props = defineProps({
  proformas: Array,
  stockLists: Object,
});
// Affichage dans la console
console.log('Proformas reçues du contrôleur:', props.proformas);
///////////////////////////////////////////


const now = new Date();
const date = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].date : now.toISOString().split('T')[0]);
const heure = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].heure : now.toTimeString().split(' ')[0]);

const numProforma = computed(() => {
    const cleanDate = date.value.replace(/-/g, '');
    const cleanTime = heure.value.replace(/:/g, '');
    return cleanDate + cleanTime;
});

const typeProforma = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].typeProforma : 'Choisir...');
const typeFiscal = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].typeFiscal : 'Choisir...');
const client = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].client : 'Choisir...');
const acheteur = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].acheteur : '');
const commercial = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].commercial : 'Choisir...');
const vendeur = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].vendeur : 'Choisir...');
const da = ref(props.proformas.length > 0 ? props.proformas[props.proformas.length - 1].da : '');

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

    form.post('/facturation-proformat', {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            console.log(page.props.message);
        },
    });
};



    // recherche article debut
        const searchDesignation = ref('');

        let result_regexp = ref([]);

        watch(searchDesignation, (newVal) => {

            let regex = RegExp(newVal.toUpperCase());

            let new_result_regexp = props.stockLists.data.filter(item => regex.test(item.DESIGNATION.toUpperCase()));

            result_regexp.value = newVal == 0 ? [] : new_result_regexp;
        });
    // recherche article fin

    //

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

    const precompte = ref(0);

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

// Fonction pour envoyer les articles au contrôleur
const enregistrer = () => {
    form.post('enregistrer', {
        preserveState: true,
        preserveScroll: true,
        data: {
            codeProforma: numProforma.value,
            articles: articlesSelectionnes.value.map(article => ({
                designation: article.DESIGNATION,
                pu: article.PU,
                qte: article.QTE,
                remise: article.REMISE,
                uv: article.UV
            }))
        },
        onSuccess: (response) => {
            console.log('Réponse du serveur:', response);
        },
        onError: (errors) => {
            console.error('Erreur lors de l\'enregistrement:', errors);
        }
    });
};

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

