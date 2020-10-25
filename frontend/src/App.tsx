import React from 'react';
import { Tabs, Tab, Container, Col, Nav, Row } from 'react-bootstrap';
import './App.css';
import Single from "./components/Single";
import Multi from "./components/Multi";
class App extends React.Component<{}, { value: string }> {
  render() {
    return (
      <Container className="App">
        <h1>{process.env.REACT_APP_NAME}</h1>
        <div className="border-bottom pb-1 mb-4">{process.env.REACT_APP_DESCRIPTION}</div>
        <Tab.Container id="left-tabs-example" defaultActiveKey="single">
          <Row>
            <Col sm={3}>
              <Nav variant="pills" className="flex-column">
                <Nav.Item>
                  <Nav.Link eventKey="single">短縮URL作成</Nav.Link>
                </Nav.Item>
                <Nav.Item>
                  <Nav.Link eventKey="mulit">一括作成</Nav.Link>
                </Nav.Item>
              </Nav>
            </Col>
            <Col sm={9}>
              <Tab.Content>
                <Tab.Pane eventKey="single">
                  <Single></Single>
                </Tab.Pane>
                <Tab.Pane eventKey="mulit">
                  <Multi></Multi>
                </Tab.Pane>
              </Tab.Content>
            </Col>
          </Row>
        </Tab.Container>
      </Container >
    );
  }
}
export default App;
