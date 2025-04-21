<template>
    <!-- 🔍 Barre de recherche sticky -->
    <div class="sticky-top bg-white py-3 shadow-sm z-3" style="top: 0;">
        <div class="container">
            <div class="row g-2 align-items-center">
                <!-- Select filtre -->
                <div class="col-md-3">
                    <select class="form-select" v-model="critere">
                        <option value="commercial">Commercial</option>
                        <option value="client">Client</option>
                        <option value="numProforma">Numéro Proforma</option>
                        <option value="statut">Statut</option>
                    </select>
                </div>

                <!-- Input de recherche -->
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" class="form-control" v-model="recherche" @input="afficherSuggestions = true"
                            :placeholder="'Rechercher par ' + critere" />
                        <!-- Suggestions -->
                        <ul class="list-group position-absolute w-100" v-if="afficherSuggestions && suggestions.length"
                            style="z-index: 10">
                            <li v-for="(sugg, i) in suggestions" :key="i" class="list-group-item list-group-item-action"
                                @click="choisirSuggestion(sugg)">
                                {{ sugg }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bouton reset -->
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100" type="button"
                        @click="resetRecherche">Réinitialiser</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 📋 Zone de résultats filtrés -->
    <div class="container mt-4" v-if="proformasFiltres.length">
        <div class="card">
            <div class="card-body">
                <h5>Résultats pour "{{ recherche }}" dans {{ critere }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(proforma, index) in proformasFiltres" :key="proforma.id">
                        <strong>#{{ index + 1 }}</strong> - {{ proforma.numProforma }} ({{ proforma.date }}) - Client :
                        {{ proforma.client }} - Commercial : {{ proforma.commercial }} - Statut :
                        <span :class="proforma.statut === 0 ? 'text-danger' : 'text-success'">
                            {{ proforma.statut }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 🔽 Tableau principal -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des Proformas</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Numéro</th>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Acheteur</th>
                                        <th>Statut</th>
                                        <th>Commercial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(proforma, index) in props.proformas" :key="proforma.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ proforma.numProforma }}</td>
                                        <td>{{ proforma.date }}</td>
                                        <td>{{ proforma.client }}</td>
                                        <td>{{ proforma.acheteur }}</td>
                                        <td :class="proforma.statut === 0 ? 'bg-danger' : 'text-success'">
                                            {{ proforma.statut }}
                                        </td>
                                        <td>{{ proforma.commercial }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    sessionData: Object,
    user: Object,
    proformas: Object
});

const form = useForm({});
const submitForm = () => form.post('/deconnexion');

// 🔍 Logique recherche multiple
const recherche = ref('');
const critere = ref('commercial');
const afficherSuggestions = ref(false);

const resetRecherche = () => {
    recherche.value = '';
    afficherSuggestions.value = false;
};

// Suggestions dynamiques selon le critère
const suggestions = computed(() => {
    const val = recherche.value.toLowerCase().trim();
    if (!val) return [];

    let valeurs = props.proformas
        .map(p => p[critere.value])
        .filter(Boolean)
        .map(v => String(v)); // s'assurer que tout est en string

    const uniques = [...new Set(valeurs)];

    const startsWith = uniques.filter(v => v.toLowerCase().startsWith(val));
    const includes = uniques.filter(v => v.toLowerCase().includes(val) && !v.toLowerCase().startsWith(val));

    return [...startsWith, ...includes];
});

const choisirSuggestion = (val) => {
    recherche.value = val;
    afficherSuggestions.value = false;
};

// Proformas filtrés
const proformasFiltres = computed(() => {
    const val = recherche.value.toLowerCase().trim();
    if (!val) return [];

    return props.proformas.filter(p => {
        const champ = p[critere.value];
        return champ && String(champ).toLowerCase().includes(val);
    });
});
</script>
