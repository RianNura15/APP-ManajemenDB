<template>
    <div>
        <!-- Existing form elements -->

        <!-- Form to create a new table -->
        <form @submit.prevent="createTable">
            <div>
                <label for="table_name">Table Name:</label>
                <input type="text" id="table_name" v-model="newTable.table_name">
            </div>
            <div v-for="(column, index) in newTable.columns" :key="index">
                <label for="column_name">Column Name:</label>
                <input type="text" v-model="column.name">
                <label for="column_type">Column Type:</label>
                <select v-model="column.type">
                    <option value="string">String</option>
                    <option value="integer">Integer</option>
                    <!-- Add more column types as needed -->
                </select>
                <button type="button" @click="removeColumn(index)">Remove Column</button>
            </div>
            <button type="button" @click="addColumn">Add Column</button>
            <button type="submit">Create Table</button>
        </form>

        <div v-if="message">
            <p>{{ message }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            form: {
                // Existing form fields
            },
            newTable: {
                table_name: '',
                columns: [{ name: '', type: 'string' }]
            },
            message: ''
        };
    },
    methods: {
        // Existing methods
        addColumn() {
            this.newTable.columns.push({ name: '', type: 'string' });
        },
        removeColumn(index) {
            this.newTable.columns.splice(index, 1);
        },
        createTable() {
            axios.post('/create-table', this.newTable)
                .then(response => {
                    this.message = response.data.message;
                    // Clear the form after successful creation
                    this.newTable = { table_name: '', columns: [{ name: '', type: 'string' }] };
                })
                .catch(error => {
                    console.error(error);
                    this.message = 'Error creating table: ' + error.message;
                });
        }
    }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>
