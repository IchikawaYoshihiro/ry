import React from 'react';
import { Button, Form } from 'react-bootstrap';
import { Api } from "../services/api";

interface Converted {
  original: string;
  tiny: string;
}
export default class Multi extends React.Component<{}, { original: string, tinies: Converted[] }> {
  constructor(props: any) {
    super(props);
    this.state = { original: '', tinies: [] };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(event: any) {
    this.setState({ original: event.target.value });
  }

  async handleSubmit(event: any) {
    event.preventDefault();
    const urls: string[] = this.state.original.split('\n').map(url => url.trim());
    const res = await Api.createMany(urls);

    if (res && res.data) {
      this.setState({
        tinies: Object.keys(res.data).map(k => {
          return { original: k, tiny: res.data[k] }
        })
      });

      console.log(this.state.tinies)

    }
  }
  dlItems(items: Converted[]) {
    return items.map((item, index) => {
      return [<dt key={`${index}-dt`}>{item.original}</dt>, <dd key={`${index}-dd`}>{item.tiny}</dd>]
    }).flat();
  }

  render() {
    return (
      <div>
        <div className="mb-3">URLをまとめて短縮URLに変換します。<br />URLは1行に1つずつ指定してください。</div>
        <Form onSubmit={this.handleSubmit}>
          <Form.Control
            className="mb-3"
            as="textarea"
            rows={10}
            value={this.state.original}
            onChange={this.handleChange}
            placeholder={"https://google.com\nhttps://yahoo.co.jp"}
          />
          <Button
            type="submit"
            className="mb-3"
            variant="primary"
          >作成</Button>
          <h6>短縮URL</h6>
          <dl>
            {this.dlItems(this.state.tinies)}
          </dl>
        </Form>
      </div>
    );
  }
}
