import React from 'react';
import { ListGroup, Form, Row } from 'react-bootstrap';
import Messages from './Messages';
import { sendMessage } from '../../actions/user';

const Conversations = ({ clients, getMessagesBack, messages, username, newMessage, changeMessageBack, sendMessageBack, activeConv }) => {
  console.log('Clients component conv', clients);
  console.log('messages conv: ', messages);
  const handleClick = (e) => {
    getMessagesBack(e.target.id);
  };

  const handleChange = (e) => {
    changeMessageBack(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    sendMessageBack();
  };

  const dataClients = clients.map((client) => {
    const activate = client.slug === activeConv ? true : false;
    return (
      <ListGroup.Item active={activate} onClick={handleClick} id={client.slug} key={client.slug}>
        {client.username}
      </ListGroup.Item>
    );
  });

  return (
    <div className="tchat">
      <ListGroup className="tchat__clients">
        {dataClients}
      </ListGroup>
      <div className="tchat__messages">
        <Messages messages={messages} username={username} />
        <Form onSubmit={handleSubmit}>
          <Row>
            <Form.Control onChange={handleChange} name='newMessageBack' type='text' value={newMessage} placeholder='Tapez votre message' />
          </Row>
        </Form>
      </div>

    </div>
  );
};

export default Conversations;
