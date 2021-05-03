@extends('layouts.admin')

@section('title', 'review')

@section('content')
    <div class="container-fluid school-container">
      <div class="col-11 mx-auto py-3 school-head-card">
        <div class="row school-head">
          <div class="col-sm-1 d-none d-sm-block"></div>
          <div class="review-title col text-sm-start text-center px-0">受講料は高めだと思う、、<span class="school-follow ms-sm-5 ms-2"><a href="#"><i class="far fa-2x fa-thumbs-up"></i></a>23</span></div>
        </div>
        <div class="row">
          <div class="col-sm-1 col-2"></div>
          <div class="col-sm-11 col-10 total-rank">
            <p>投稿したユーザー&emsp;<i class="fas fa-user"></i>太郎</p>
          </div>
        </div>
      </div>

      <div class="school-statistics d-md-flex justify-content-between">
        <div class="left-contents mx-auto">
          <div class="left-contents-inner">
            <div class="radar-chart">
              <canvas id="radar"></canvas>
              <!-- Chart.js -->
              <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
              <script>
              var ctx = document.getElementById('radar');
              var myChart = new Chart(ctx, {
                type: 'radar',
                data: {
                  labels: [
                    '料金',
                    '期間',
                    'カリキュラム',
                    'メンター',
                    '転職支援',
                    'スタッフ',
                  ],
                  datasets: [{
                    label: 'hoge太郎さんのスクールに対する満足度',
                    data: [5, 3, 2, 4, 0, 1],
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                  }]
                },
                options: {
                  elements: {
                    line: {
                      borderWidth: 1
                    }
                  },
                  scales: {
                    r: {
                        angleLines: {
                            display: false
                        },
                        suggestedMin: 0,
                        suggestedMax: 5
                    }
                  }
                },
              });
              </script>
            </div>
          </div>
        </div>

        <div class="right-contents mt-md-0 mt-5 mx-auto">
          <div class="right-contents-inner">
            <div class="tuition text-center pb-5">
                <p>hoge太郎さんの受講料</p>
                <h1>￥</h1>
            </div>
      
            <div class="term text-center pb-5">
              <p>hoge太郎さんの平均受講時期</p>
              <h1>X年X月～X年X月</h1>
            </div>
      
            <div class="overall-satisfaction text-center">
              <p>hoge太郎サンの総合満足度</p>
              <div class="star-rating">
                <div class="star"></div><span class="star-rate">3.0</span>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="review-text-card col-11 mx-auto p-5">
          <p>hoge太郎さんの感想</p>
        <div class="row">
          <div class="col-12 col-md review-text">
            <p>あああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
          </div>
        </div>
      </div>

        <div id="app">
            <message-component></message-component>
        </div>
    </div>
@endsection