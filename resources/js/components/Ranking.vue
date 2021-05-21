<template>
  <div class="ranking-order d-flex justify-content-end">
    <label for="並べ替え" style="color: white;">並べ替え：</label>
    <select class="form-select" aria-label="並べ替え" @change="sortSchools(sortType)" v-model="sortType">
      <option v-for="item in sortOptions" :value="item.value">{{ item.text }}</option>
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
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="st_mentor" data-bs-toggle="tab" href="#st_mentor" role="tab" aria-controls="st_mentor" aria-selected="false" @click="showSchoolList('st_mentor')">メンター</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="st_support" data-bs-toggle="tab" href="#st_support" role="tab" aria-controls="st_support" aria-selected="false" @click="showSchoolList('st_support')">転職支援</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="st_staff" data-bs-toggle="tab" href="#st_staff" role="tab" aria-controls="st_staff" aria-selected="false" @click="showSchoolList('st_staff')">スタッフ</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="total_judg" role="tabpanel" aria-labelledby="total_judg">
        <a v-bind:href="'/schools/' +school.school_id" class="list-group-item list-group-item-action" v-for="school in schoolList">{{ school['school_name'] }}&emsp;{{ school['column'] }}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //データを保持
      schoolList: [],
      sortType: 'desc',
      sortOptions: [
        { text: '高い順', value: 'desc'},
        { text: '低い順', value: 'asc'},
      ]
    }
  },
  mounted() {
    this.showSchoolList('total_judg')
  },
  methods: {
    showSchoolList(columnName) {
      axios.post('/rankings', {
        'columnName' : columnName
      })
      .then(response => {
        this.schoolList = response.data.schoolList
        this.sortSchools(this.sortType);
      });
    },
    sortSchools(sortType) {
      this.schoolList = this.schoolList.sort(function(a, b) {
        if (sortType == 'desc') {
          return b.column - a.column;
        } else {
          return a.column - b.column;
        }
      });
    },
  }
}
</script>