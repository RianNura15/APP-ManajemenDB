<template>
    <div>
        <button @click="showData = true">Tambah Data</button>
        <div v-if="showData">
            <h2>Edit Data</h2>
            <form @submit.prevent="addData">
                <div>
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" v-model="newData.nama">
                </div>
                <div>
                    <label for="nim">NIM:</label>
                    <input type="number" id="nim" v-model="newData.nim">
                </div>
                <div>
                    <label for="jurusan">Jurusan:</label>
                    <input type="text" id="jurusan" v-model="newData.jurusan">
                </div>
                <div>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" v-model="newData.alamat">
                </div>
                <div>
                    <label for="nohp">No. HP:</label>
                    <input type="text" id="nohp" v-model="newData.nohp">
                </div>
                <!-- Tambahkan input lain sesuai dengan properti model Anda -->
                <button type="submit">Simpan</button>
                <button type="button" @click="showData = false">Cancel</button>
            </form>
        </div>
        <h2>Data List</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
            <tr v-for="item in dataList" :key="item.id">
                <td>{{ item.nama }}</td>
                <td>{{ item.nim }}</td>
                <td>{{ item.jurusan }}</td>
                <td>{{ item.alamat }}</td>
                <td>{{ item.nohp }}</td>
                <td>
                    <button @click="editData(item)">Edit</button>
                    <button @click="deleteData(item.id)">Hapus</button>
                </td>
            </tr>
        </table>
        <div v-if="selectedItem">
            <h2>Edit Data</h2>
            <form @submit.prevent="updateData">
                <div>
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" v-model="selectedItem.nama">
                </div>
                <div>
                    <label for="nim">NIM:</label>
                    <input type="number" id="nim" v-model="selectedItem.nim">
                </div>
                <div>
                    <label for="jurusan">Jurusan:</label>
                    <input type="text" id="jurusan" v-model="selectedItem.jurusan">
                </div>
                <div>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" v-model="selectedItem.alamat">
                </div>
                <div>
                    <label for="nohp">No. HP:</label>
                    <input type="text" id="nohp" v-model="selectedItem.nohp">
                </div>
                <!-- Tambahkan input lain sesuai dengan properti model Anda -->
                <button type="submit">Update</button>
                <button type="button" @click="selectedItem = null">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            dataList: [],
            selectedItem: null,
            showData: false,
            newData: {
                nama: '',
                nim: '',
                jurusan: '',
                alamat: '',
                nohp: ''
            }
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/data') // Sesuaikan dengan endpoint Anda
                .then(response => {
                    this.dataList = response.data; // Simpan data ke dalam dataList
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
        addData() {
            axios.post('/tambah-data', this.newData) // Sesuaikan dengan endpoint Anda
                .then(response => {
                    console.log('Data added:', response.data);
                    this.newData = { // Reset newData setelah penambahan berhasil
                        nama: '',
                        nim: '',
                        jurusan: '',
                        alamat: '',
                        nohp: ''
                    };
                    this.showData = false; // Sembunyikan form setelah penambahan berhasil
                    this.fetchData(); // Reload data setelah penambahan
                })
                .catch(error => {
                    console.error('Error adding data:', error);
                });
        },
        deleteData(id) {
            axios.delete(`/delete-data/${id}`) // Sesuaikan dengan endpoint Anda
                .then(response => {
                    console.log('Data deleted:', response.data);
                    this.fetchData();
                })
                .catch(error => {
                    console.error('Error deleting data:', error);
                });
        },
        editData(item) {
            this.selectedItem = { ...item }; // Membuat salinan data untuk diedit
        },
        updateData() {
            axios.put(`/edit-data/${this.selectedItem.id}`, this.selectedItem) // Sesuaikan dengan endpoint Anda
                .then(response => {
                    console.log('Data updated:', response.data);
                    this.selectedItem = null; // Reset selectedItem setelah pembaruan berhasil
                    this.fetchData();
                })
                .catch(error => {
                    console.error('Error updating data:', error);
                });
        }
    }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>
