class TreeNode:
 def _init__(self, data):
self. data = data
self. left =  None
self. right = None

root = TreeNode('R')
nodeA - TreeNode('A')
nodeß = TreeNode('B')
nodeC - TreeNode('C')
nodeD = TreeNode ('D')
nodeE - TreeNode( 'E')
nodeF = TreeNode('F')
nodeG - TreeNode ('G')

root. left = nodeA
root. right - nodeB

nodeA. left - nodec nodeA. right - nodeD
nodeß. left = nodeE nodes. right - nodeF

nodef. left - nodeG

#test
print("root.right.left.data:", root.right.left.data) 