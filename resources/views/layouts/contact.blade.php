
        <form action="/contacts" method="post" enctype="multipart/form-data">
          @csrf
          <input name="name" id="name">
          <button type="submit" class="btn btn-success">
              この内容で登録する
          </button>
        </form>
       