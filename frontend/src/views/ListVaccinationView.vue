<script setup>
import SectionHeader from '../components/SectionHeader.vue';
import Alert from '../components/Alert.vue'
import { onBeforeMount, ref } from "vue"
import Api from '../services/api'
import changeFormat from '../services/date'

const token = localStorage.getItem('token')
const isLoading = ref(false)
let consultation = ref('')
let vaccinations = ref('')

const getConsultation = async () => {
    isLoading.value = true
    const res = await new Api(`/consultations?token=${token}`, 'GET').getConsultation()
    const data = await res.json()

    if (res.status == 200) {
        isLoading.value = false
        consultation.value = data.consultations
    } else {
        alert('Error = ' + data.message)
    }
}

const getVaccinations = async () => {
    isLoading.value = true
    const res = await new Api(`/vaccinations?token=${token}`, 'GET').getVaccinations()
    const data = await res.json()

    if (res.status == 200) {
        isLoading.value = false
        vaccinations.value = data.vaccinations
    } else {
        alert('Error = ' + data.message)
    }
}
onBeforeMount( async () => {
    await getConsultation()
    await getVaccinations()
})


</script>
<template>
<!-- S: List Vaccination Section -->
    <section class="consultation-section mb-5">
        <SectionHeader title="My Vaccinations" />
        <div class="section-body" v-if="!isLoading">
            <div class="row mb-4">

                <!-- S: First Vaccination info -->
                <div class="col-md-12" v-if="!consultation || (consultation && consultation.status == 'pending')">
                    <Alert type="warning" text="Your consultation must be approved by doctor to get the vaccine." />
                </div>
                <!-- E: First Vaccination info -->

                <!-- S: Link to Register First Vaccination -->
                <div class="col-md-4" v-if="consultation && consultation.status == 'accepted' && !vaccinations.first">
                    <div class="card card-default">
                        <div class="card-header border-0">
                            <h5 class="mb-0">First Vaccination</h5>
                        </div>
                        <div class="card-body">
                            <a href="">+ Register vaccination</a>
                        </div>
                    </div>
                </div>
                <!-- E: Link to Register First Vaccination -->
                <div class="col-md-4" v-if="vaccinations.first">
                    <div class="card card-default">
                        <div class="card-header border-0">
                            <h5 class="mb-0">First Vaccination</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <tr>
                                    <th>Status</th>
                                    <td class="text-muted">
                                        <span class="badge badge-info" v-if="vaccinations.first.status == 'registered'">Registered</span>
                                        <span class="badge badge-primary" v-if="vaccinations.first.status == 'done'">Vaccinated</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td class="text-muted">
                                        {{ changeFormat(vaccinations.first.vaccination_date) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Spot</th>
                                    <td class="text-muted">{{ vaccinations.first.spot.name }}</td>
                                </tr>
                                <tr>
                                    <th>Vaccine</th>
                                    <td class="text-muted">
                                        <span v-if="vaccinations.first.vaccine">{{ vaccinations.first.vaccine.name }}</span>
                                        <span v-else>-</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Vaccinator</th>
                                    <td class="text-muted">
                                        <span v-if="vaccinations.first.vaccinator">{{ vaccinations.first.vaccinator.name }}</span>
                                        <span v-else>-</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- S: Link to Register Second Vaccination -->
                <div class="col-md-4" v-if="vaccinations.first && vaccinations.first.status == 'done' && !vaccinations.second">
                    <div class="card card-default">
                        <div class="card-header border-0">
                            <h5 class="mb-0">Second Vaccination</h5>
                        </div>
                        <div class="card-body">
                            <a href="">+ Register vaccination</a>
                        </div>
                    </div>
                </div>
                <!-- E: Link to Register Second Vaccination -->

                <!-- S: Second Vaccination Box (Registered) -->
                <div class="col-md-4" v-if="vaccinations.second">
                    <div class="card card-default">
                        <div class="card-header border-0">
                            <h5 class="mb-0">Second Vaccination</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <tr>
                                    <th>Status</th>
                                    <td class="text-muted">
                                         <span class="badge badge-info" v-if="vaccinations.second.status == 'registered'">Registered</span>
                                        <span class="badge badge-primary" v-if="vaccinations.second.status == 'done'">Vaccinated</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td class="text-muted">{{ changeFormat(vaccinations.second.vaccination_date) }}</td>
                                </tr>
                                <tr>
                                    <th>Spot</th>
                                    <td class="text-muted">{{ vaccinations.second.spot.name }}</td>
                                </tr>
                                <tr>
                                    <th>Vaccine</th>
                                    <td class="text-muted">
                                        <span v-if="vaccinations.second.vaccine">{{ vaccinations.second.vaccine.name }}</span>
                                        <span v-else>-</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Vaccinator</th>
                                    <td class="text-muted">
                                        <span v-if="vaccinations.second.vaccinator">{{ vaccinations.second.vaccinator.name }}</span>
                                        <span v-else>-</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- S: Second Vaccination Box (Registered) -->
            </div>
        </div>
        <h4 class="text-center" v-else>Loading Vaccinations List..</h4>
    </section>
    <!-- E: List Vaccination Section -->
</template>