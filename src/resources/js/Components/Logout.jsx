export default function () {
  return (
    <a target="_blank" rel="noopener noreferrer" onClick={Logout}>
      退出
    </a>
  )
}

function Logout() {
  axios.post(route('logout'))
    .then(function (response) {
      location.reload();
    })
    .catch(function (error) {
      console.log(error);
    });
}