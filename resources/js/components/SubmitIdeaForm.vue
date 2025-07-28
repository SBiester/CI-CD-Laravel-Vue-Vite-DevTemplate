<template>
  <div class="wlc">
    <h2>Hallo {{ userName }}, hier kannst du deine Ideen einreichen</h2>
  </div>
  <div class="form-container">
    <form @submit.prevent="submitIdea">
      <div class="grid-container">
        <!-- Title -->
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" v-model="title" class="form-control" required />
        </div>

        <!-- Einreicher*innen -->
        <div class="form-group">
          <label for="einreicher">Einreicher*innen</label>
          <input type="text" id="einreicher" v-model="newContributor" class="form-control" 
            @input="filterUsers"
            @blur="hideSuggestions"
            @focus="filterUsers"
          />
          <ul v-if="showSuggestions" class="suggestions-list">
            <li v-for="(user, index) in filteredUsers" :key="index" @click="selectUser(user)">
              {{ user.displayName }} ({{ user.email }})
            </li>
          </ul>

          <ul class="mt-2">
            <li v-for="(contributor, index) in contributors" :key="contributor.email">
              {{ contributor.displayName }} ({{ contributor.email }})
              <button type="button" class="btn btn-sm btn-danger" @click="removeContributor(index)">
                X
              </button>
            </li>
          </ul>
        </div>

        <!-- Lösungsbeschreibung -->
        <div class="form-group">
          <label for="description" class="form-label">Lösungsbeschreibung</label>
          <textarea id="description" v-model="description" class="form-control"></textarea>
        </div>

        <!-- Problembeschreibung -->
        <div class="form-group">
          <label for="issue" class="form-label">Problembeschreibung</label>
          <textarea id="issue" v-model="issue" class="form-control"></textarea>
        </div>

        <!-- Anmerkungen -->
        <div class="form-group">
          <label for="notes" class="form-label">Anmerkungen</label>
          <textarea id="notes" v-model="notes" class="form-control"></textarea>
        </div>

        <!-- Attachment -->
        <div class="form-group">
          <label for="file" class="form-label">Attachment</label>
          <input type="file" id="file" @change="handleFileUpload" class="form-control" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="btn">
        <button type="submit" class="btn-submit">Senden</button>
      </div>
    </form>
  </div>
</template>


<script>
import { ref, watch, onMounted } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const router = useRouter();
    const title = ref('');
    const description = ref('');
    const issue = ref('');
    const notes = ref('');
    const userName = ref('');
    const userEmail = ref('');
    const newContributor = ref('');
    const contributors = ref([]);
    const file = ref(null);

    
    const allUsers = ref([]);
    const filteredUsers = ref([]);
    const showSuggestions = ref(false);

    
    const fetchUserName = async () => {
      try {
        const response = await axios.get('/user/manager');
        userName.value = response.data.userName;
        userEmail.value = response.data.userMail;
      } catch (error) {
        console.error('Error fetching userName:', error);
      }
    };

   
    const fetchUsers = async () => {
      try {
        const response = await axios.get('/users/all');
        allUsers.value = response.data;
      } catch (error) {
        console.error('Fehler beim Laden der Benutzer:', error);
      }
    };

    
    watch(userName, (newValue) => {
      if (newValue) {
        fetchUsers();
      }
    });

    
    const filterUsers = () => {
      if (!newContributor.value) {
        filteredUsers.value = [];
        showSuggestions.value = false;
        return;
      }
      const query = newContributor.value.toLowerCase();
  filteredUsers.value = allUsers.value
    .filter(user => user.displayName.toLowerCase().includes(query))
    .slice(0, 5); 
  showSuggestions.value = filteredUsers.value.length > 0;
};

   
    const selectUser = (user) => {
      newContributor.value = user.displayName;
      addContributor(user);
      showSuggestions.value = false;
    };

    
    const addContributor = (user = null) => {
      if (user) {
        contributors.value.push({ displayName: user.displayName, email: user.email });
      } else {
        const existingUser = allUsers.value.find(u => u.displayName === newContributor.value);
        if (existingUser) {
          contributors.value.push({ displayName: existingUser.displayName, email: existingUser.email });
        }
      }
      newContributor.value = '';
      filteredUsers.value = [];
    };

    
    const removeContributor = (index) => {
      contributors.value.splice(index, 1);
    };

    
    const hideSuggestions = () => {
      setTimeout(() => {
        showSuggestions.value = false;
      }, 200);
    };

    const handleFileUpload = (event) => {
      file.value = event.target.files[0];
    };

    const submitIdea = async () => {
      try {
        const formData = new FormData();
        formData.append('title', title.value);
        formData.append('description', description.value);
        formData.append('issue', issue.value);
        formData.append('notes', notes.value);
        formData.append('creator', userName.value);
        formData.append('email', userEmail.value);

        // 🔹 Теперь передаем в `contributors` массив объектов `{ displayName, email }`
        formData.append('contributors', JSON.stringify(contributors.value));

        if (file.value) {
          formData.append('file', file.value);
        }
        console.log("📨 daten gesendet:", Object.fromEntries(formData.entries()));

        const response = await axios.post('/api/ideas', formData);

        Swal.fire({ icon: 'success', title: 'Erfolg!', text: 'Idee gespeichert!' });

        if (response.data.file_url) {
      console.log("📁 Datei hochgeladen:", response.data.file_url);
      alert(`Datei hochgeladen: ${response.data.file_url}`);
    }

        title.value = '';
        description.value = '';
        notes.value = '';
        issue.value = '';
        contributors.value = [];
        file.value = null;
      } catch (error) {
        console.error('Fehler:', error);
      }
    };

    onMounted(fetchUserName);

    return { title, description, issue, notes, userName, newContributor, contributors, addContributor, submitIdea, handleFileUpload, filteredUsers, showSuggestions, filterUsers, selectUser, hideSuggestions, removeContributor };
  }
};
</script>

<style scoped>
@import '../../css/app.css';
@import 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
@import 'https://unpkg.com/filepond/dist/filepond.css';
@import 'http://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
</style>
