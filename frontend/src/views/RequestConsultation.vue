<script setup>
import Api from '../services/api'
import { ref } from '@vue/reactivity'

const hasDisease = ref('no')
const hasSymptoms = ref('no')


</script>
<template>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <form action="">
                <div class="d-flex align-items-center mb-3">
                    <label for="disease-history" class="mr-3 mb-0">Do you have disease history ?</label>
                    <select class="form-control-sm" v-model="hasDisease">
                        <option value="yes">Yes, I have</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <textarea v-if="hasDisease == 'yes'" id="disease-history" class="form-control" cols="30" rows="10" placeholder="Describe your disease history"></textarea>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <form action="">
                <div class="d-flex align-items-center mb-3">
                    <label for="current-symptoms" class="mr-3 mb-0">Do you have symptoms now ?</label>
                    <select class="form-control-sm" v-model="hasSymptoms">
                        <option value="yes">Yes, I have</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <textarea v-if="hasSymptoms == 'yes'" id="current-symptoms" class="form-control" cols="30" rows="10" placeholder="Describe your current symptoms"></textarea>
                </form>
            </div>
        </div>
    </div>

    <button class="btn btn-primary">Send Request</button>
</template>