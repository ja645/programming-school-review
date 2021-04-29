@extends('layouts.admin')

@section('title', 'school')

@section('content')
<div class="container-fluid">

<div class="row school-head d-flex justify-content-sm-between">
  <div class="col">
    <div class="school-name d-flex">Tech::HOGEHOGE
      <a href="#"><i class="far fa-heart fa-2x"></i></a>
      <!-- <a href="#"><i class="fas fa-heart fa-2x"></i></a> -->
      <div class="school-follow">
        23フォワー
      </div>
    </div>
    <div class="row">
      
      <div class="col total-rank">
        <p>総合ランキング12位</p>
      </div>
      <div class="col review-counts">
        <p>レビュー件数：　34件</p>
      </div>
      
    </div>
  </div>

  <!-- <img class="col-2 image-fluid school-image p-0" src="../../../public/images/4386694_s.jpg"> -->
</div>

<!-- <div class="row">
  <img class="center-image" src="../../../public/images/1570892460489.jpg">
</div> -->

<div class="row school-statistics d-flex justify-content-center">

  <div class="col-md col-12 left-contents">
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
            label: 'このスクールの満足度',
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

  <div class="col-md col-12 right-contents">

    <div class="tuition">
        <p>このスクールの平均受講料</p>
        <h1>￥560,000</h1>
    </div>

    <div class="term">
      <p>このスクールの平均受講期間</p>
      <h1>3ヶ月</h1>
    </div>

    <div class="overall-satisfaction">
      <p>このスクールの平均満足度</p>
      <div class="star-rate">
        
        <div class="front">
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <!-- <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>
          <i class="fas fa-star fa-3x"></i>           -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="school-name">Tech::HOGEHOGE</div>
  <div class="school-address">東京都hogehoge区hogehoge　hogehogeビル1F</div>
  <div class="school-feature">
    <ul>
      <li>オンラインのみ</li>
      <li>Mac必須</li>
      <li>転職成功で受講料キャッシュバック</li>
    </ul>
  </div>
</div>

<div class="review-list">
  <p>このスクールに寄せられたレビュー</p>
  <a href="#" class="list-group-item list-group-item-action">The current link item</a>
  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
  <a href="#" class="list-group-item list-group-item-action">A fifth link item</a>
  <a href="#">他のレビューを見る<i class="fas fa-angle-double-right"></i></a>
</div>

</div>

@endsection