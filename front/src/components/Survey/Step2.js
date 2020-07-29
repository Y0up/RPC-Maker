import React, { Component } from 'react';
import { Form, Col, Button } from 'react-bootstrap';
import './styles.scss';

export class Step2 extends Component {
  continue = (e) => {
    e.preventDefault();
    this.props.nextStep();
  };

  back = (e) => {
    e.preventDefault();
    this.props.prevStep();
  };

  render() {
    return (
      <div>
        <div>
          <h2>Question budget</h2>
        </div>
        <div>
          <h1>Pour mieux vous servir un budget pourrait nous servir, En avez vous defini un?</h1>
        </div>
        <Form className="Form">
          <Form.Row>
            <Col>
              <Button className="bouton" variant="primary" type="submit"> Oui </Button>
            </Col>
            <Col>
              <Button className="bouton" variant="primary" type="submit"> Non </Button>
            </Col>
          </Form.Row>
          <Form.Row>
            <Col>
              <Form.Control placeholder="Budget" />
            </Col>
            <Col>
              <Form.Control placeholder="Marge" />
            </Col>
          </Form.Row>
        </Form>
        <Form.Row>
          <Col>
            <Button className="bouton" variant="primary" type="submit" onClick={this.back}> Precedent </Button>
          </Col>
          <Col>
            <Button className="bouton" variant="primary" type="submit" onClick={this.continue}> Suivant </Button>
          </Col>
        </Form.Row>
      </div>
    );
  }
}

export default Step2;
