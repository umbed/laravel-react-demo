import 'antd/dist/reset.css'
import './App.css'

import React, { useState } from 'react';
import {
  MenuFoldOutlined,
  MenuUnfoldOutlined,
  UserOutlined,
  VideoCameraOutlined,
} from '@ant-design/icons';
import { Layout, Menu, Button, theme } from 'antd';
import Logo from "./components/Logo"

import { BrowserRouter, Routes, Route } from "react-router-dom";
import { Link } from "react-router-dom";

import Home from "./view/Home"
import About from "./view/About.jsx"

const { Header, Sider, Content } = Layout;


const menuItems = [
  {
    key: '1',
    icon: <UserOutlined />,
    label: <Link to="/">Home</Link>,
  },
  {
    key: '2',
    icon: <VideoCameraOutlined />,
    label: <Link to="/about">About</Link>,
  },
]

function View() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/about" element={<About />} />
    </Routes>
  )
}


const App: React.FC = () => {
  const [collapsed, setCollapsed] = useState(false);
  const { token: { colorBgContainer }, } = theme.useToken();

  return (
    <BrowserRouter>

      <Layout>
        <Sider trigger={null} collapsible collapsed={collapsed}>
          <div className="demo-logo-vertical" style={{ textAlign: "center" }}>
            <Logo />
          </div>
          <Menu theme="dark" mode="inline" defaultSelectedKeys={['1']} items={menuItems} />
        </Sider>

        <Layout style={{ width: '100%' }} >
          <Header style={{ padding: 0, background: colorBgContainer }}>
            <Button
              type="text"
              icon={collapsed ? <MenuUnfoldOutlined /> : <MenuFoldOutlined />}
              onClick={() => setCollapsed(!collapsed)}
              style={{ fontSize: '16px', width: 64, height: 64, }}
            />
          </Header>

          <Content style={{ background: colorBgContainer, }} >
            <View />
          </Content>
        </Layout>

      </Layout>

    </BrowserRouter>
  );
};

export default App;
