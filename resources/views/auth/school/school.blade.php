@extends('layouts.admin')

@section('title', 'school')

@section('content')

    <div class="col-11 mx-auto school-head-card">
      <div class="row school-head">
        <div class="col-sm-1 d-none d-sm-block"></div>
        <div class="school-name col text-sm-start text-center px-0">{{ $school->school_name }}<span id="like"><like-component :school="{{ json_encode($school) }}"  style="display: inline-block;"></like-component></span></div>
      </div>
      <div class="row">
        <div class="col-sm-1 col-2"></div>
        <div class="col-sm-11 col-10 total-rank">
          <p>総合ランキング{{ $school_rank }}位&emsp;レビュー件数{{ $school->reviews->count() }}件</p>
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
            var school = @json($school);
            var st = @json($satisfactions);
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
                  label: school.school_name + 'の満足度',
                  data: [st['st_tuition'], st['st_term'], st['st_curriculum'], st['st_mentor'], st['st_support'], st['st_staff']],
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
              <p>{{ $school->school_name }}の平均受講料</p>
              <h1>約{{ $tuition_average }}円</h1>
          </div>
    
          <div class="term text-center pb-5">
            <p>{{ $school->school_name }}の平均受講期間</p>
            <h1>{{ $term_average }}ヶ月</h1>
          </div>
    
          <div class="overall-satisfaction text-center">
            <p>{{ $school->school_name }}の平均満足度</p>
            <div class="star-rating">
              <div class="star">★★★★★
                <div id="star-after" class="star-after">★★★★★</div>
                <script type="text/javascript">
                  const total_judg = @json($satisfactions['total_judg']) * 20;
                  window.onload = function () {
                    var star_after = document.getElementById('star-after');
                    star_after.style.width = total_judg + "%";
                  };
                </script>
              </div>
              <div class="star-rate">{{ $satisfactions['total_judg'] }}</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="school-info-card col-11 mx-auto">
      <div class="p-5">
        <div>{{ $school->school_name }}の特徴</div>
        <div class="p-4">
          <ul>
            @foreach($school->features as $feature)
              <li>{{ $feature }}</li>
            @endforeach
          </ul>
        </div>
        <div class="d-flex justify-content-end">
          <a href="{{ $school->school_url }}">公式ページを見る<i class="fas fa-angle-double-right"></i></a>
        </div>
      </div>
    </div>
      
    <div class="col-11 school-reviews-card p-5">
      <p>{{ $school->school_name }}に寄せられたレビュー</p>
      @if($school->reviews->isEmpty())
        <p class="py-4">まだレビューがありません</p>
      @else
        <div class="review-list">
          @foreach ($school->reviews->take(5) as $review)
          <a href="{{ url('/reviews/review/' . $review->id) }}"  class="list-group-item list-group-item-action">{{ $review->title }}</a>
          @endforeach
        </div>
        
        <div class="d-flex justify-content-end">
          <a href="{{ url('/reviews/school/' . $school->id) }}" class="text-align: center;">他のレビューを見る<i class="fas fa-angle-double-right"></i></a>
        </div>
      @endif
    </div>

@endsection