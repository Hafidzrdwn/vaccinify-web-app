<script setup>
import SectionHeader from '../components/SectionHeader.vue'
import { onBeforeMount, ref } from "vue"
import Api from '../services/api'

const token = localStorage.getItem('token')
const isLoading = ref(false)
let consultation = ref('')

const getConsultation = async () => {
    isLoading.value = true
    const res = await new Api(`/consultations?token=${token}`, 'GET').getConsultation()
    const data = await res.json()
    
    if (res.status == 200) {
        isLoading.value = false
        consultation.value = data.consultations
    } else {
        alert('Error = '+ data.message)
    }
}
onBeforeMount(() => {
    getConsultation()
})

</script>
<template>
<section class="consultation-section mb-5">
    <SectionHeader title="My Consultation"/>
    <div class="row" v-if="!isLoading">
        <!-- S: Link to Request Consultation -->
        <div class="col-md-4" v-if="!consultation">
            <div class="card card-default">
                <div class="card-header">
                    <h5 class="mb-0">Consultation</h5>
                </div>
                <div class="card-body">
                    <router-link to="/request-consultation">+ Request consultation</router-link>
                </div>
            </div>
        </div>
        <!-- E: Link to Request Consultation -->

        <!-- S: Society Consultation Box (Pending) -->
        <div class="col-md-4" v-else>
            <div class="card card-default">
                <div class="card-header border-0">
                    <h5 class="mb-0">Consultation</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge badge-info" v-if="consultation.status== 'pending'">Pending</span>
                                <span class="badge badge-primary" v-if="consultation.status == 'accepted'">Accepted</span>
                                <span class="badge badge-danger" v-if="consultation.status == 'declined'">Declined</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Disease History</th>
                            <td class="text-muted">
                                <span v-if="consultation.disease_history">
                                    {{ consultation.disease_history }}
                                </span>
                                <span v-else>-</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Current Symptoms</th>
                            <td class="text-muted">
                                <span v-if="consultation.current_symptoms">
                                    {{ consultation.current_symptoms }}
                                </span>
                                <span v-else>-</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Doctor Name</th>
                            <td class="text-muted">
                                <span v-if="consultation.doctor">
                                    {{ consultation.doctor.name }}
                                </span>
                                <span v-else>-</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Doctor Notes</th>
                            <td class="text-muted">
                                <span v-if="consultation.doctor_notes">
                                    {{ consultation.doctor_notes }}
                                </span>
                                <span v-else>-</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- E: Society Consultation Box (Pending) -->
    </div>
    <h4 v-else class="text-center">Loading..</h4>
</section>
</template>