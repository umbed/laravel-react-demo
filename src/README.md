# 框架说明
使用Laravel 10

# 启动说明

1. 初次拉取代码没有包含vendor目录。
2. `docker-compose.yml`文件中包含了command指令，在初次使用时取消注释，执行 `docker compose up` 启动容器，会自动执行`composer install` 命令安装扩展，然后容器会停止运行，这个时候扩展也拉取了，vendor目录也生成了。
3. 然后再注释掉 command ，再次在次执行 `docker compose up`
4. 容器启动后，进入容器执行`php artisan migrate` 数据库迁移（这个只是创建laravel认证部分用到），后续的数据库需要复制创建数据表的sql到数据库执行。
5. 前端页面文件需要通过`npm install`拉取扩展，然后执行`npm run dev`运行开发环境或者`npm run build`构建打包文件。参考[Blade模板说明](#blade)

<span id="blade"></span>
# Blade模板说明

使用Breeze & Blade 构建前端页面，
资源导入在resources目录下


在 views/ 目录下的blade.php 文件中使用@vite导入js和css文件。
```php
// vite应该是通过manifest.json文件识别到构建后的资源并导入
@vite(['resources/css/app.css', 'resources/js/app.js'])
```


编译完成之后进入容器使用

```bash
# 进入容器
docker exec -it '容器id' bash
# 构建js文件和css文件，构建之后的文件在 public/build 文件夹中，其中manifest.json文件中记录了构建的映射表。
npm run build
```

开发环境可以使用dev，dev 会开启一个vite服务器，默认端口指向 5173，vite会自动指向这个端口。并且支持热更新

```bash
# 如果运行了vite服务器 会优先指向dev，停止vite后才指向build
npm run dev 
# 但是在docker容器中跳转会出问题,解决这个问题可以用--host启动，或者编辑vite.config.js文件
npm run dev --host 0.0.0.0
```

编辑编辑vite.config.js解决docker容器中跳转这个问题，
需要加上下面这段，将默认只允许本机访问的127.0.0.1修改成允许外部访问的0.0.0.0，并且开放docker容器的5173端口。
```js
server: {
    host: "0.0.0.0",
    hmr: {
        host: "localhost"
    }
}
```

构建方式使用vite，参考[vite文档](https://cn.vitejs.dev/guide/backend-integration.html)
vite的配置文件为 `vite.config.js`

----

## 资源引入

使用`npm run build`构建时，会自动打包需要用到的资源。

<br />
以下是登录注册页面默认用到的，
resources/layout 中全局引用下面的文件，
ES6语法通过import引入。

`resources/js/bootstrap.js` 中引入了 [axios](https://www.axios-http.cn/) 用来发送网络请求，就不在使用jquery的ajax啦

`resources/css/app.css` 中通过 @tailwind 加载了[Tailwind](https://www.tailwindcss.cn/docs/installation) , 配置文件为 tailwind.config.js 



<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


