@extends('layouts.admin')

@section('title', 'review')

@section('content')
    <div class="container-fluid school-container">
      <div class="col-11 mx-auto py-3 review-head-card">
        <div class="row school-head">
          <div class="col-sm-1 d-none d-sm-block"></div>
          <div class="review-title col text-sm-start text-center px-0">{{ $review->title }}<span id="follow"><follow-component :review="{{ json_encode($review) }}"  style="display: inline-block;"></follow-component></span></div>
        </div>
        <div class="row">
          <div class="col-sm-1 col-2"></div>
          <div class="col-sm-11 col-10 total-rank">
            <p>投稿したユーザー&emsp;<i class="fas fa-user"></i>{{ $review->user->user_name }}</p>
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
              const review = @json($review);
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
                    label: review.user.user_name + 'さんのスクールに対する満足度',
                    data: [review.st_tuition, review.st_term, review.st_curriculum, review.st_mentor, review.st_support, review.st_staff],
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
                <p>{{ $review->user->user_name }}さんの受講料</p>
                <h1>{{ $review->tuition }}円</h1>
            </div>
      
            <div class="term text-center pb-5">
              <p>{{ $review->user->user_name }}さんの受講時期</p>
              <h1>{{ $review->when_start->format('Y年m月d日') }}～{{ $review->when_end->format('Y年m月d日') }}</h1>
            </div>
      
            <div class="overall-satisfaction text-center">
              <p>{{ $review->user->user_name }}さんの総合満足度</p>
              <div class="star-rating">
                <div class="star">★★★★★
                  <div id="star-after" class="star-after">★★★★★</div>
                  <script type="text/javascript">
                    const total_judg = @json($review->total_judg) * 20;
                    window.onload = function () {
                      var star_after = document.getElementById('star-after');
                      star_after.style.width = total_judg + "%";
                    };
                  </script>
                </div>
                <div class="star-rate">{{ $review->total_judg }}</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="review-text-card col-11 mx-auto p-5">
          <p>{{ $review->user->user_name }}さんの感想</p>
        <div class="row">
          <div class="col-12 col-md review-text">
            <p>{{ $review->report }}</p>
          </div>
        </div>
      </div>

        <div id="app">
            <message-component :review="{{ json_encode($review) }}">></message-component>
        </div>
    </div>
@endsection