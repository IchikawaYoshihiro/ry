import React from 'react';
import { Button, Form } from 'react-bootstrap';
import { Api } from "../services/api";
export default class Single extends React.Component<{}, { original: string, tiny?: string }> {
  constructor(props: any) {
    super(props);
    this.state = { original: '', tiny: '' };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(event: any) {
    this.setState({ original: event.target.value });
  }

  async handleSubmit(event: any) {
    event.preventDefault();
    const res = await Api.create(this.state.original);

    if (res && res.data) {
      this.setState({ tiny: res.data });
    }
  }

  render() {
    return (
      <div>
        <div className="mb-3">URLを指定して短縮URLを作成できます。<br />最大文字数は255文字です。</div>
        <Form onSubmit={this.handleSubmit}>
          <Form.Control
            className="mb-3"
            type="url"
            placeholder="https://google.com"
            value={this.state.original}
            onChange={this.handleChange}
          />
          <Button
            type="submit"
            className="mb-3"
            variant="primary"
          >作成</Button>
          <h6>短縮URL</h6>
          <Form.Control type="url" value={this.state.tiny} readOnly ></Form.Control>
        </Form>
      </div>
    );
  }
}
