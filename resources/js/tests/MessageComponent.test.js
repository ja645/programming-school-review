import { mount } from '@vue/test-utils'
import MessageComponent from './components/Message'

describe('MessageComponent', () => {
  const wrapper = mount(MessageComponent)

  it('message-componentがhtml出力されることをテスト', () => {
    expect(wrapper.html()).toContain('<div class="container"></div>')
  })
})