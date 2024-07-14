<template>
    <div>
        <form @submit.prevent="submitForm">
            <div>
                <label for="table">Table Name:</label>
                <input type="text" id="table" v-model="form.table">
            </div>
            <div>
                <label for="column">Column Name:</label>
                <input type="text" id="column" v-model="form.column">
            </div>
            <div>
                <label for="type">New Type:</label>
                <select v-model="form.type">
                    <option value="VARCHAR">Varchar</option>
                    <option value="INTEGER">Integer</option>
                    <option value="CHAR">Char</option>
                </select>
            </div>
            <div>
                <label for="lengthType">Panjang / Nilai Type:</label>
                <input type="text" id="lengthType" v-model="form.lengthType">
            </div>
            <div>
                <label for="referenceTable">Reference Table:</label>
                <input type="text" id="referenceTable" v-model="form.referenceTable">
            </div>
            <div>
                <label for="referenceColumn">Reference Column:</label>
                <input type="text" id="referenceColumn" v-model="form.referenceColumn">
            </div>
            <div>
                <button type="button" @click="changeColumnType">Change Column Type</button>
                <button type="button" @click="addPrimaryKey">Add Primary Key</button>
                <button type="button" @click="addAutoIncrement">Add Auto Increment</button>
                <button type="button" @click="deleteAutoIncrement">Delete Auto Increment</button>
                <button type="button" @click="allowNull">Allow NULL</button>
                <button type="button" @click="disallowNull">Disallow NULL</button>
                <button type="button" @click="changePrimaryKey">Change Primary Key</button>
                <button type="button" @click="changeForeignKey">Change Foreign Key</button>
            </div>
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
                table: '',
                column: '',
                type: '',
                lengthType: '',
                oldPrimaryKey: '',
                newPrimaryKey: '',
                oldForeignKey: '',
                newForeignKey: '',
                referenceTable: '',
                referenceColumn: ''
            },
            message: ''
        };
    },
    methods: {
        submitForm() {
            // Placeholder to prevent page refresh
        },
        changeColumnType() {
            axios.post('/change-column-type', {
                table: this.form.table,
                column: this.form.column,
                type: this.form.type,
                lengthType: this.form.lengthType,
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
                this.message = 'Error creating table: ' + error.message;
            });
        },
        addPrimaryKey() {
            axios.post('/add-primary-key', {
                table: this.form.table,
                column: this.form.column
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
                this.message = 'Error creating table: ' + error.message;
            });
        },
        addAutoIncrement() {
            axios.post('/add-auto-increment', {
                table: this.form.table,
                column: this.form.column
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        },
        deleteAutoIncrement() {
            axios.post('/delete-auto-increment', {
                table: this.form.table,
                column: this.form.column,
                type: this.form.type,
                lengthType: this.form.lengthType,
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        },
        allowNull() {
            axios.post('/allow-null', {
                table: this.form.table,
                column: this.form.column,
                type: this.form.type,
                lengthType: this.form.lengthType,
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        },
        disallowNull() {
            axios.post('/disallow-null', {
                table: this.form.table,
                column: this.form.column,
                type: this.form.type,
                lengthType: this.form.lengthType,
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        },
        changePrimaryKey() {
            axios.post('/change-primary-key', {
                table: this.form.table,
                column: this.form.column,
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        },
        changeForeignKey() {
            axios.post('/change-foreign-key', {
                table: this.form.table,
                old_foreign_key: this.form.oldForeignKey,
                new_foreign_key: this.form.newForeignKey,
                reference_table: this.form.referenceTable,
                reference_column: this.form.referenceColumn
            }).then(response => {
                this.message = response.data.message;
            }).catch(error => {
                console.error(error);
            });
        }
    }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>
