@extends('layouts.admin')

@section('title', 'school')

@section('content')
<div class="school-background">
  <div class="container-fluid school-container">
    <div class="col-11 mx-auto school-head-card">
      <div class="row school-head">
        <div class="col-sm-1 d-none d-sm-block"></div>
        <div class="school-name col text-sm-start text-center px-0">{{ $school->school_name }}<span class="school-follow ms-sm-5 ms-2"><a href="#"><i class="far fa-heart fa-2x"></i></a>{{ $school->follow }}</span></div>
      </div>
      <div class="row">
        <div class="col-sm-1 col-2"></div>
        <div class="col-sm-11 col-10 total-rank">
          <p>総合ランキング
          ]
          
          位&emsp;レビュー件数34件</p>
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
            var tuition = @json($school->tuition);
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
                  label: 'このスクールの満足度',
                  data: [this.tuition, 3, 2, 4, 0, 5],
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
              <p>このスクールの平均受講料</p>
              <h1>￥</h1>
          </div>
    
          <div class="term text-center pb-5">
            <p>このスクールの平均受講期間</p>
            <h1>ヶ月</h1>
          </div>
    
          <div class="overall-satisfaction text-center">
            <p>このスクールの平均満足度</p>
            <div class="star-rating">
              <div class="star">3.0</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="school-info-card col-11 mx-auto">
      <div class="row">
        <div class="col-sm-1 d-none d-sm-block"></div>
        <div class="col-12 col-md school-address py-5">
          <p>所在地：東京都hogehoge区hogehoge　hogehogeビル1F</p>
          <p>url</p>
        </div>
        <div class="col-12 col-md school-feature py-5">
          <ul>
            <li>オンラインのみ</li>
            <li>Mac必須</li>
            <li>転職成功で受講料キャッシュバック</li>
          </ul>
        </div>
      </div>
    </div>
      
    <div class="col-11 mx-auto school-reviews-card p-5">
      <p>このスクールに寄せられたレビュー</p>
      <div class="review-list">
        @foreach ($reviews as $review)
        <a href="{{ url('/review/' . $review->id) }}"  class="list-group-item list-group-item-action">{{ $review->title }}</a>
        @endforeach
      </div>
      <a href="{{ url('/reviews/' . $school->id) }}">他のレビューを見る<i class="fas fa-angle-double-right"></i></a>
    </div>
  </div>
</div>

@endsection