<template>
    <div>
        <form @submit.prevent="fetchColumns">
            <div>
                <label for="table">Table Name:</label>
                <input type="text" id="table" v-model="tableName">
            </div>
            <button type="submit">Get Columns</button>
        </form>
        <div v-if="columns.length">
            <h2>Columns in {{ tableName }}</h2>
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Type</th>
                    <th>NULL / NOT NULL</th>
                    <th>Primary Key</th>
                    <th>Auto Increment</th>
                    <th>Aksi</th>
                </tr>
                <tr v-for="column in columns" :key="column.Field">
                    <td>{{ column.Field }}</td>
                    <td>{{ column.Type }}</td>
                    <td>{{ column.Null === 'NO' ? 'NOT NULL' : 'NULL' }}</td>
                    <td>{{ column.Key ? '' + '✅' : '' }}</td>
                    <td>{{ column.Extra ? '' + '✅' : '' }}</td>
                    <td>
                        <button @click="editData(item)">Edit</button>
                        <button @click="deleteData(item.id)">Hapus</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tableName: '',
            columns: []
        };
    },
    methods: {
        fetchColumns() {
            axios.post('/data-columns', { table: this.tableName })
                .then(response => {
                    this.columns = response.data;
                })
                .catch(error => {
                    console.error('Error fetching columns:', error);
                });
        }
    }
}
</script>
