<template>
  <div class="ranking-order d-flex justify-content-end">
    <label for="並べ替え">並べ替え：</label>
    <select class="form-select" aria-label="並べ替え">
      <option selected @click="sortSchoolsDesc()">評価の高い順</option>
      <option value="1" @click="sortSchoolsAsc()">評価の低い順</option>
    </select>
  </div>

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
      <div v-if="toggle" class="tab-pane fade show active" id="total_judg" role="tabpanel" aria-labelledby="total_judg">
        <a v-bind:href="'/schools/' +school.school_id" class="list-group-item list-group-item-action" v-for="school in schoolList">{{ school }}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //データを保持
      schoolList : '',
      toggle : true
    }
  },
  computed: {
    sortSchoolsDesc: function () {
      return this.schoolList.sort((a, b) => {
        return b.column_average - a.column_average;
      });
    },
    sortSchoolsAsc: function () {
      return this.schoolList.sort((a, b) => {
        return a.column_average - b.column_average;
      });
    }
  },
  mounted() {
    sortSchoolsDesc()
  },
  methods: {
    showSchoolList(columnName) {
      axios.post('/rankings', {
        'columnName' : columnName
      })
      .then(response => {
        this.schoolList = response.data.schoolList
      });
    },
    sortSchoolsDesc() {
      return this.schoolList.sort((a, b) => {
        return b.column_average - a.column_average;
      });
    },
    sortSchoolsAsc() {
      return this.schoolList.sort((a, b) => {
        return a.column_average - b.column_average;
      });
    },
    changeToggle() {
      this.toggle == true ? this.toggle = false : this.toggle = true
    },
  }
}
</script>