<template>
  <div class="ranking-list">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="total_judg" data-bs-toggle="tab" href="#total_judg" role="tab" aria-controls="total_judg" aria-selected="true" @click="showSchoolList('total_judg')">総合評価</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="st_tuition" data-bs-toggle="tab" href="#st_tuition" role="tab" aria-controls="st_tuition" aria-selected="false" @click="showSchoolList('st_tuition')">料金</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="st_curriculum" data-bs-toggle="tab" href="#st_curriculum" role="tab" aria-controls="st_curriculum" aria-selected="false" @click="showSchoolList('st_curriculum')">カリキュラム</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="total_judg" role="tabpanel" aria-labelledby="total_judg">
        <a href="#" class="list-group-item list-group-item-action" v-for="school in schools">{{ school }}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //データを保持
      schools : '',
    }
  },
  methods: {
    showSchoolList(columnName) {
      axios.post('/api/rankings', {
        'columnName' : columnName
      })
      .then(response => this.schools = response.data);
    }
  }
}
</script>
