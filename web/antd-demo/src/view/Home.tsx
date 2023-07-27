import { Link } from "react-router-dom";
import axios from 'axios';

export default function Home() {
  return (
    <>
      <div> 这是 主页 使用tsx</div>
      <Link to="/about">去 About 页</Link>
      <button onClick={testHttpRequest}>test</button>
    </>
  )
}

function testHttpRequest() {
  const server = "/antd";
  axios.get(server)
    .then(function (response) {
      // 处理成功情况
      console.log(response);
    })
    .catch(function (error) {
      // 处理错误情况
      console.log(error);
    })
    .then(function () {
      // 总是会执行
    });
}
