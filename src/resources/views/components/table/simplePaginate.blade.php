<div id="page" class="row" style="margin-top:10px;"></div>

<script>
  var page_data;

  // 处理分页
  function paginate(data, callback) {
    // console.log(data)
    page_data = data
    var str = `<nav aria-label="..."  class="col-lg-6 d-flex justify-content-end" >\
                    <ul class="pagination">\
                        <li class="page-item ${(data.prev_page_url == null ? "disabled" : "")}">\
                            <a class="page-link" href="#" onclick="jump(${(data.current_page - 1)},${callback})">上页</a>\
                        </li>\
                        <li class="page-item active">\
                            <a class="page-link" href="#" onclick="jump(${data.current_page},${callback})">${data.current_page}</a>\
                        </li>\
                        <li class="page-item ${(page_data.next_page_url == null ? "disabled" : "")}">\
                            <a class="page-link" href="#" onclick="jump(${(data.current_page + 1)},${callback})">下页</a>\
                        </li>\
                    </ul>\
                </nav>`;

    var info = `<div class="col-lg-6">显示第 ${page_data.from} 至 ${page_data.to} 行</div>`

    str = info + str;
    $('#page').html(str)
  }

  //分页跳转
  function jump(page, callback) {
    let url = `${page_data.path}?page=${page}&limit=${page_data.per_page}`
    callback(url)
  }
</script>