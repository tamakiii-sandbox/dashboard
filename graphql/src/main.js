const fs = require('fs')
const path = require('path')
const { ApolloServer, gql } = require('apollo-server')
const schema = fs.readFileSync(path.join(__dirname, 'schema.graphql'))

const { RESTDataSource } = require('apollo-datasource-rest');

class Hello extends RESTDataSource {
  constructor() {
    super();
    this.baseURL = 'http://nginx/';
  }

  async getHello() {
    const result = this.get(`hello`)
    console.log(result)
    return result
  }
}

const typeDefs = gql`${schema}`

const resolvers = {
  Query: {
    hello: async (source, _, { dataSources }) => {
      return dataSources.hello.getHello();
    }
  }
}

const server = new ApolloServer({
  typeDefs,
  resolvers,
  dataSources: () => ({
    hello: new Hello
  }),
  introspection: true,
  playground: true,
})

server.listen().then(({ url }) => {
  console.log(`🚀 Server ready at ${url}`);
})
