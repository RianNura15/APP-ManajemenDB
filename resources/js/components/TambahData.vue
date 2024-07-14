<template>
    <div>
        <h2>Add New Data</h2>
        <form @submit.prevent="submitForm">
            <div>
                <label for="nama">Nama:</label>
                <input type="text" id="nama" v-model="formData.nama">
            </div>
            <div>
                <label for="nim">NIM:</label>
                <input type="number" id="nim" v-model="formData.nim">
            </div>
            <div>
                <label for="jurusan">Jurusan:</label>
                <input type="text" id="jurusan" v-model="formData.jurusan">
            </div>
            <div>
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" v-model="formData.alamat">
            </div>
            <div>
                <label for="nohp">No. HP:</label>
                <input type="text" id="nohp" v-model="formData.nohp">
            </div>
            <!-- Tambahkan input sesuai dengan struktur data yang ingin Anda tambahkan -->
            <button type="submit">Add Data</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                nama: '',
                nim: '',
                jurusan: '',
                alamat: '',
                nohp: ''
            }
        };
    },
    methods: {
        submitForm() {
            axios.post('/tambah-data', this.formData) // Sesuaikan dengan endpoint Anda
                .then(response => {
                    console.log('Data added');
                    // Reset form after successful submission
                    this.formData.nama = '';
                    this.formData.nim = '';
                    this.formData.jurusan = '';
                    this.formData.alamat = '';
                    this.formData.nohp = '';
                })
                .catch(error => {
                    console.error('Error adding data:', error);
                });
        }
    }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>
