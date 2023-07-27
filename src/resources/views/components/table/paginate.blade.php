<div id="page" class="row" style="margin-top:10px;"></div>

<script>
  var page_data;

  // 处理分页
  function paginate(data, callback) {
    // console.log(data)
    page_data = data

    var str = '<nav aria-label="..."  class="col-lg-6 d-flex justify-content-end" >\
               <ul class="pagination">\
                  <li class="page-item ' + (data.prev_page_url == null ? "disabled" : "") + '">\
                      <a class="page-link" href="#" onclick="jump(' + (data.current_page - 1) + ',' + callback + ')">上页</a>\
                  </li>\
                  <li class="page-item ' + (data.current_page == 1 ? "active" : "") + '">\
                    <a class="page-link" href="#" onclick="jump(1,' + callback + ')">' + 1 + '</a>\
                  </li>';

    if (data.current_page > 2) {
      str += '<li class="page-item disable">\
                <a class="page-link" href="#">...</a>\
              </li>';
    }
    if (data.current_page > 1 && data.current_page != data.last_page) {
      str += '<li class="page-item active">\
                <a class="page-link" href="#" onclick="jump(' + data.current_page + ',' + callback + ')">' + data.current_page + '</a>\
              </li>'
    }

    if ((data.last_page - data.current_page) > 1) {
      str += '<li class="page-item disable">\
                <a class="page-link" href="#">...</a>\
              </li>'
    }
    if (data.last_page > 1) {
      str += '<li class="page-item ' + (data.current_page == data.last_page ? "active" : "") + '">\
                <a class="page-link" href="#" onclick="jump(' + data.last_page + ',' + callback + ')">' + data.last_page + '</a>\
              </li>';
    }

    str += '<li class="page-item ' + (data.next_page_url == null ? "disabled" : "") + '">\
                <a class="page-link" href="#" onclick="jump(' + (data.current_page + 1) + ',' + callback + ')">下页</a>\
              </li>\
            </ul>\
            </nav>';

    var info = '<div class="col-lg-6">显示第 ' + data.from + ' 至 ' + data.to + ' 行，共 ' + data.total + ' 行</div>'

    str = info + str;
    $('#page').html(str)
  }

  //分页跳转
  function jump(page, callback) {
    let url = `${page_data.path}?page=${page}&limit=${page_data.per_page}`
    callback(url)
  }
</script>