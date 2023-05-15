<script setup>
import Api from '../services/api'
import Alert from '../components/Alert.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const isLoading = ref(false)
const success = ref(false)
const hasDisease = ref('no')
const hasSymptoms = ref('no')
const token = localStorage.getItem('token')
const router = useRouter()

const form = ref({
    disease_history: null,
    current_symptoms: null
})

const request_consult = async () => {
    isLoading.value = true
    const res = await new Api(`/consultations?token=${token}`, 'POST', form.value).requestConsultation()
    const data = await res.json()

    if (res.status == 200) {
        isLoading.value = false
        success.value = true
        window.scrollTo(0, 0)
        hasDisease.value = 'no'
        hasSymptoms.value = 'no'
        setTimeout(() => {
            success.value = false
            router.push('/dashboard')
        }, 1500);
    } else {
        alert(data.message)
    }
}
</script>
<template>
<form action="" @submit.prevent="request_consult">
    <Alert type="success" text="Request consultation successful" v-show="success" />
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <div class="d-flex align-items-center mb-3">
                    <label for="disease-history" class="mr-3 mb-0">Do you have disease history ?</label>
                    <select class="form-control-sm" v-model="hasDisease">
                        <option value="yes">Yes, I have</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <textarea v-show="hasDisease == 'yes'" id="disease-history" class="form-control" cols="30" rows="10" placeholder="Describe your disease history" v-model="form.disease_history"></textarea>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <div class="d-flex align-items-center mb-3">
                    <label for="current-symptoms" class="mr-3 mb-0">Do you have symptoms now ?</label>
                    <select class="form-control-sm" v-model="hasSymptoms">
                        <option value="yes">Yes, I have</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <textarea v-show="hasSymptoms == 'yes'" id="current-symptoms" class="form-control" cols="30" rows="10" placeholder="Describe your current symptoms" v-model="form.current_symptoms"></textarea>
            </div>
        </div>
    </div>
    
    <button class="btn btn-primary" @click.prevent="request_consult">
        <span v-if="!isLoading">Send Request</span>
        <span v-else>Loading...</span>
    </button>
</form>
</template>