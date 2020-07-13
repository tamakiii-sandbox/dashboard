const { ApolloServer, gql } = require('apollo-server')
// const { typeDefs, resolvers } = require('./schema')

const typeDefs = gql`
  type Query {
    hello: String
  }
`
const resolvers = {
  Query: {
    hello: () => 'world'
  }
}

const server = new ApolloServer({
  typeDefs,
  resolvers,
  introspection: true,
  playground: true,
})

server.listen().then(({ url }) => {
  console.log(`🚀 Server ready at ${url}`);
})
