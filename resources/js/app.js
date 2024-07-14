import { createApp } from 'vue';
import DatabaseForm from './components/DatabaseForm.vue';
import TambahForm from './components/TambahForm.vue';
import Data from './components/Data.vue';
import TambahData from './components/TambahData.vue';
import DataColumn from './components/DataColumn.vue';

const app = createApp({});
app.component('database-form', DatabaseForm);
app.component('tambah-form', TambahForm);
app.component('data-list', Data);
app.component('tambah-data', TambahData);
app.component('data-column', DataColumn);
app.mount('#app');
