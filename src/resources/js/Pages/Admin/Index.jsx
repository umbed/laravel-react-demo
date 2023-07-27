import 'antd/dist/reset.css'
import './Index.css'

import {
  MenuFoldOutlined,
  MenuUnfoldOutlined,
  UserOutlined,
  VideoCameraOutlined,
  DownOutlined
} from '@ant-design/icons';
import { Layout, Menu, Button, theme, Dropdown, Space } from 'antd';

import React, { useState } from 'react';
import { BrowserRouter, Routes, Route } from "react-router-dom";
import { Link } from "react-router-dom";
import Logo from "@/Components/Logo"
import Logout from '@/Components/Logout';
// import Home from "./view/Home"
// import About from "./view/About.jsx"

const { Header, Sider, Content } = Layout;


const menuItems = [
  {
    key: '1',
    icon: <UserOutlined />,
    label: <Link to="/dashboard">Home</Link>,
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
      <Route path="/dashboard" element={"home"} />
      <Route path="/about" element={"about"} />
    </Routes>
  )
}

const dropdownItems = [
  {
    key: '1',
    label: (
      <a target="_blank" rel="noopener noreferrer" href={route('profile.edit')}>
        编辑
      </a>
    ),
  },
  {
    key: '2',
    danger: true,
    label: (<Logout />),
  },
];



export default function Dashboard({ auth }) {
  const [collapsed, setCollapsed] = useState(false);
  const { token: { colorBgContainer }, } = theme.useToken();

  return (
    <BrowserRouter>

      <Layout>
        <Sider trigger={null} collapsible collapsed={collapsed}>
          <div className="demo-logo-vertical"
            style={{
              display: "flex",
              justifyContent: "center",
            }}>
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

            <Dropdown
              menu={{ items: dropdownItems, }}
            >
              <a onClick={(e) => e.preventDefault()}>
                <Space>
                  Click
                  <DownOutlined />
                </Space>
              </a>
            </Dropdown>

          </Header>

          <Content style={{ background: colorBgContainer, }} >
            <View />
          </Content>
        </Layout>

      </Layout>

    </BrowserRouter>
  );
};
